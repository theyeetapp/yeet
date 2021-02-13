
@extends('layouts/auth_app')

@section('content') 

    <div class='grid grid-cols-12 col-gap-5 mb-5 md:mt-5 lg:mt-0'>
        @foreach($results as $result)
            <div class='col-span-12 md:col-span-4 bg-white flex flex-col mb-5 p-5 shadow'>
                <p class='m-0 mb-3 symbol'>{{ $result->symbol }}</p>
                <p class='m-0 mb-3 text-sm name'>{{  strlen($result->company) > 40 ? substr($result->company, 0, 37) . '...' : $result->company }}</p>
                <p class='m-0 text-sm hidden type'>{{ $result->type }}</p>
                <div class='flex flex-row justify-between items-center'>
                    <p class='m-0 cursor-pointer text-sm action 
                    {{ in_array($result->symbol, $subscriptions) ? "action-unsubscribe" : "action-subscribe" }}'>
                        {{ in_array($result->symbol, $subscriptions) ? 'unsubscribe' : 'subscribe' }}
                    </p>
                    
                    @if(in_array($result->symbol, $subscriptions))
                        <i class='fa fa-check-circle' style='color:#537A5A'></i>
                    @else 
                        <i class='fa' style='color:#537A5A'></i>
                    @endif
                </div>
            </div>
        @endforeach
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
