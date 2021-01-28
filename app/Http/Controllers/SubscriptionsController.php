<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Crypto;
use App\Models\Stock;
use App\Models\Subscription;

class SubscriptionsController extends Controller
{
    protected $request;
    protected $names;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function show() {
        $user = Auth::user();
        $subscriptions = $user->subscriptions;
        return view('subscriptions')
        ->with('title', 'Subscriptions')
        ->with('subscriptions', $subscriptions)
        ->with('type', 'all');
    }

    public function update($type) {
        $subscriptions = explode('|', $this->request->subscriptions);
        $unsubscriptions = explode('|', $this->request->unsubscriptions);
        $this->names = json_decode($this->request->names, true);

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
            $this->unsubscribe($unsubscriptions, $type);
        }

        $this->request->session()->flash('message', 'updated successfully');
        return back();
    }

    public function subscribe($subscriptions, $type) {

        foreach($subscriptions as $subscription) {
            if($type === 'stocks') {
                $stock = Stock::firstOrCreate(['symbol' => $subscription], ['name' => $this->names[$subscription]]);
                Subscription::create(['user_id' => Auth::user()->id,
                'market_id' => $stock->id,
                'market_type' => 'stock']);
            }
            else if($type === 'crypto') {
                $crypto = Crypto::firstOrCreate(['symbol' => $subscription], ['name' => $this->names[$subscription]]);
                Subscription::create(['user_id' => Auth::user()->id,
                'market_id' => $crypto->id,
                'market_type' => 'crypto']);
            }
        }
    }

    public function unsubscribe($unsubscriptions, $type) {

        if(type === 'all') {
            // $stock = Stock::
        }
        else if($type === 'stocks') {
            $stockIds = Stock::select('id')->whereIn('symbol', $unsubscriptions)->get();
            Subscription::where('user_id', Auth::user()->id)
            ->where('market_type', 'stock')
            ->whereIn('market_id', $stockIds)
            ->delete();
        }
        else if($type === 'crypto') {
            $cryptoIds = Crypto::select('id')->whereIn('symbol', $unsubscriptions)->get();
            Subscription::where('user_id', Auth::user()->id)
            ->where('market_type', 'crypto')
            ->whereIn('market_id', $cryptoIds)
            ->delete();
        }
       
    }
}
