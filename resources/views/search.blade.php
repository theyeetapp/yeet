
@extends('layouts/auth_app')

@section('content') 

    <div class='grid grid-cols-12 col-gap-5 mb-5 md:mt-5 lg:mt-0'>
        @if(count($results) > 0)
            <div class='col-span-12 text-lg text-gray-800 lg:text-md mb-5'>
                {{ $total }} search result(s) for "{{ $searchTerm }}"
            </div>
            @foreach($results as $result)
                <div class='col-span-12 md:col-span-4 bg-white flex flex-col mb-5 p-5 shadow'>
                    <p class='m-0 mb-3 symbol'>{{ $result->symbol }}</p>
                    <p class='m-0 mb-3 text-sm'>{{  strlen($result->company) > 40 ? substr($result->company, 0, 37) . '...' : $result->company }}</p>
                    <p class='hidden name'>{{ $result->company }}</p>
                    <p class='m-0 text-sm hidden type'>{{ $result->type }}</p>
                    <div class='flex flex-row justify-between items-center'>
                        @php
                            $isSubscribed = in_array($result->company, array_keys($subscriptions)) * in_array($result->symbol, array_values($subscriptions))
                        @endphp
                        <p class='m-0 cursor-pointer text-sm action 
                        {{ $isSubscribed ? "action-unsubscribe" : "action-subscribe" }}'>
                            {{ $isSubscribed ? "unsubscribe" : "subscribe" }}
                        </p>

                        @if($isSubscribed)
                            <i class='fa fa-check-circle' style='color:#537A5A'></i>
                        @else 
                            <i class='fa' style='color:#537A5A'></i>
                        @endif
                    </div>
                </div>
            @endforeach
        @else 
            <div class='col-span-12 no-items flex flex-row items-center justify-center'>
                <div class='flex flex-col no-items__content items-center'>
                    <img src='/images/subscriptions/direction.svg' class='no-items__image mb-8'>
                    <p class='m-0 no-items__message text-lg text-center'>No search results for "{{ $searchTerm }}"</p>
                </div>
            </div>
        @endif
    </div>
    <div class='w-full grid grid-cols-12 col-gap-5'>
        @if($index > 1 && $index <= $maxIndex)
            <div class='col-span-3 sm:col-span-2 bmd:col-span-1 p-3'>
                <a href='{{ route("search", ["symbol" => $searchTerm, "index" => $index - 1]) }}'><<<</a>
            </div>
        @endif

        @for($i = $paginateStart; $i < ($paginateStart + $numElements); $i++)
            @if($i <= $paginateMax)
                <div class='col-span-3 sm:col-span-2 bmd:col-span-1 flex flex-row justify-center p-3 mb-5 {{ $i === $paginateCurrent ? "bg-yeet-blue text-white" : "" }}'>
                    <a href='{{ route("search", ["symbol" => $searchTerm, "index" => $index, "page" => ($i - $paginateStart) + 1]) }}'>{{ $i }}</a>
                </div>
            @endif
        @endfor
        
        @if($index < $maxIndex)
            <div class='col-span-3 sm:col-span-2 bmd:col-span-1 p-3'>
                <a href='{{ route("search", ["symbol" => $searchTerm, "index" => $index + 1]) }}'>>>></a>
            </div>
        @endif
    </div>

@endsection
