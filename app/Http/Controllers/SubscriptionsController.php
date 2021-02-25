<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Symbol;
use App\Models\Subscription;

class SubscriptionsController extends Controller
{
    protected $request;
    protected $companies;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function show() {
        $index = $this->request->index ?? 1;
        $index = (int)$index;

        if(!$this->request->page) {
            $page = 1;
        }
        // else if((int)$this->request->page > 16) {
        //     return redirect()->route('subscriptions', ['index' => $index]);
        // }
        else {
            $page = $this->request->page;
        }

        $numElements = config('app.elements_per_page');
        $total = Auth::user()->subscriptionsCount();
        $numElements = config('app.elements_per_page');
        $maxIndex = (int)ceil($total / pow($numElements, 2));

        if($index > $maxIndex && ($maxIndex !== 0)) {
            return redirect()->route('subscriptions');
        }
 
        if($index === $maxIndex && ($maxIndex !== 0)) {
            $rem = $total - ($index - 1) * pow($numElements, 2);
            $remPages = ceil($rem / $numElements);
           
            if($page > $remPages) {
                return redirect()->route('subscriptions', ['index' => $index]);
            }
        }

        $start = (pow($numElements, 2) * ($index - 1)) + ($numElements * ($page - 1));
        $user = Auth::user(); 
        $subscriptions = $user->subscriptions($start, $numElements);

        $subscribedSymbols = $user->symbols();
        $symbols = array_map(function($stock) {
        return $stock['name'];
        }, $subscribedSymbols);

        return view('subscriptions')
        ->with('title', 'Subscriptions')
        ->with('subscriptions', $subscriptions)
        ->with('numElements', $numElements)
        ->with('index', $index)
        ->with('maxIndex', $maxIndex)
        ->with('paginateStart', ((($index  - 1) * $numElements) + 1))
        ->with('paginateCurrent', (($index - 1) * $numElements) + $page)
        ->with('paginateMax', ceil($total / $numElements))
        ->with('total', $total)
        ->with('type', 'all')
        ->with('symbols', $symbols);
    }

    public function update($type) {
        $subscriptions = explode('|', $this->request->subscriptions);
        $unsubscriptions = explode('|', $this->request->unsubscriptions);
        $this->companies = json_decode($this->request->companies, true);
        $this->types = json_decode($this->request->types, true);

        $subscriptions = array_filter($subscriptions, function($subscription) {
            return $subscription !== '';
        });
        $unsubscriptions = array_filter($unsubscriptions, function($unsubscription) {
            return $unsubscription !== '';
        });

        if(count($subscriptions) > 0) {
            $this->subscribe($subscriptions, $type);
        }

        if(count($unsubscriptions) > 0) {
            $this->unsubscribe($unsubscriptions);
        }

        $this->request->session()->flash('message', 'updated successfully');
        return back();
    }

    public function subscribe($subscriptions, $type) {

        foreach($subscriptions as $subscription) {
            $typeValue = $type === 'search' ? $this->types[$subscription] : $type;
            $symbol = Symbol::firstOrCreate(['name' => $subscription], ['company' => $this->companies[$subscription], 'type'=> $typeValue]);
            Subscription::create(['user_id' => Auth::id(), 'symbol_id' => $symbol->id]);
        }
    }

    public function unsubscribe($unsubscriptions) {
       $symbolIds = Symbol::select('id')
       ->whereIn('name', $unsubscriptions)
       ->get();
       Subscription::where('user_id', Auth::id())
       ->whereIn('symbol_id', $symbolIds)
       ->delete();
    }
}
