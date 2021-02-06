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
        $user = Auth::user(); 
        $subscriptions = $user->subscriptions();

        $subscribedSymbols = $user->symbols();
        $symbols = array_map(function($stock) {
        return $stock['name'];
        }, $subscribedSymbols);

        // var_dump($symbols);
        // return;

        return view('subscriptions')
        ->with('title', 'Subscriptions')
        ->with('subscriptions', $subscriptions)
        ->with('type', 'all')
        ->with('symbols', $symbols);
    }

    public function update($type) {
        $subscriptions = explode('|', $this->request->subscriptions);
        $unsubscriptions = explode('|', $this->request->unsubscriptions);
        $this->companies = json_decode($this->request->companies, true);

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
            $symbol = Symbol::firstOrCreate(['name' => $subscription], ['company' => $this->companies[$subscription], 'type'=> $type]);
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
