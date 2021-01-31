
@extends('layouts/auth_app')

@section('content')

    <div class='grid grid-cols-12 col-gap-5 mb-5'>
        @foreach($subscriptions as $subscription)
            <div class='col-span-4 bg-white flex flex-col mb-5 p-5 shadow'>
                <p class='m-0 mb-3 mr-3 symbol'>{{ $subscription->symbol->name }}</p> 
                <p class='m-0 mb-3 text-sm name'>{{  strlen($subscription->symbol->company) > 40 ? substr($subscription->symbol->company, 0, 37) . '...' : $subscription->symbol->company }}</p>
                <div class='flex flex-row justify-between items-center'>
                    <p class='m-0 cursor-pointer text-sm action action-unsubscribe'>
                        unsubscribe
                    </p>
                    <i class='fa fa-check-circle' style='color:#537A5A'></i>
                </div>
            </div>
        @endforeach
    </div>

@endsection