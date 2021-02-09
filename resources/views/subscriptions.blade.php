
@extends('layouts/auth_app')

@section('content')

    <div class='grid grid-cols-12 col-gap-5 mb-5'>
        @if(count($subscriptions) > 0)
            @foreach($subscriptions as $subscription)
                <div class='col-span-12 md:col-span-4 bg-white flex flex-col mb-5 p-5 shadow'>
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
        @else 
            <div class='col-span-12 flex flex-row items-center justify-center' style='height:calc(100vh - 150px)'>
                <div class='relative flex flex-col items-center' style='top:-8vh'>
                    <img src='/images/subscriptions/direction.svg' class='mb-8' style='width:250px'>
                    <p class='m-0 text-lg text-center' style='width:400px'>You are not subscribed to any stocks or crypto. Get subscribing. Get tracking.</p>
                </div>
            </div>
        @endif
    </div>
    <div class='w-full grid grid-cols-12 col-gap-5'>
        @if($index > 1 && $index <= $maxIndex)
            <div class='col-span-3 sm:col-span-2 bmd:col-span-1 p-3'>
                <a href='{{ route("subscriptions", ["index" => $index - 1]) }}'><<<</a>
            </div>
        @endif

        @for($i = $paginateStart; $i < ($paginateStart + $numElements); $i++)
            @if($i <= $paginateMax)
                <div class='col-span-3 sm:col-span-2 bmd:col-span-1 flex flex-row justify-center p-3 mb-5 {{ $i === $paginateCurrent ? "bg-yeet-blue text-white" : "" }}'>
                    <a href='{{ route("subscriptions", ["index" => $index, "page" => ($i - $paginateStart) + 1]) }}'>{{ $i }}</a>
                </div>
            @endif
        @endfor
        
        @if($index < $maxIndex)
            <div class='col-span-3 sm:col-span-2 bmd:col-span-1 p-3'>
                <a href='{{ route("subscriptions", ["index" => $index + 1]) }}'>>>></a>
            </div>
        @endif
    </div>

@endsection