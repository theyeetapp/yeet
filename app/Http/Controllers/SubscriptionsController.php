<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function show() {
        return view('subscriptions')->with('title', 'Subscriptions');
    }
}
