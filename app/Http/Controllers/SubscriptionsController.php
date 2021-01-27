<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Subscription;

class SubscriptionsController extends Controller
{
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function show() {
        return view('subscriptions')->with('title', 'Subscriptions');
    }

    public function update() {
        $subscriptions = explode('|', $this->request->subscriptions);
        $unsubscriptions = explode('|', $this->request->unsubscriptions);
        $names = json_decode($this->request->names, true);

        $subscriptions = array_filter($subscriptions, function($subscription) {
            return $subscription !== '';
        });
        $unsubscriptions = array_filter($unsubscriptions, function($unsubscription) {
            return $unsubscription !== '';
        });

        foreach($subscriptions as $subscription) {
            $stock = Stock::firstOrCreate(['symbol' => $subscription], ['name' => $names[$subscription]]);
            Subscription::create(['user_id' => $this->request->user()->id, 'market_id' => $stock->id, 'market_type' => 'stock']);
        }

        $this->request->session()->flash('message', 'updated successfully');
        return back();
    }
}
