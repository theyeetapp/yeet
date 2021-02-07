
@extends('layouts/auth_app')

@section('content') 

    <div class='grid grid-cols-12 col-gap-5 mb-5'>
        @foreach($stocks as $stock)
            <div class='col-span-4 bg-white flex flex-col mb-5 p-5 shadow'>
                <p class='m-0 mb-3 symbol'>{{ $stock->symbol }}</p>
                <p class='m-0 mb-3 text-sm name'>{{  strlen($stock->company) > 40 ? substr($stock->company, 0, 37) . '...' : $stock->company }}</p>
                <p class='m-0 text-sm hidden type'>{{ $type }}</p>
                <div class='flex flex-row justify-between items-center'>
                    <p class='m-0 cursor-pointer text-sm action 
                    {{ in_array($stock->symbol, $subscriptions) ? "action-unsubscribe" : "action-subscribe" }}'>
                        {{ in_array($stock->symbol, $subscriptions) ? 'unsubscribe' : 'subscribe' }}
                    </p>
                    
                    @if(in_array($stock->symbol, $subscriptions))
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
            <div class='col-span-1 p-3'>
                <a href='{{ route("stocks", ["index" => $index - 1]) }}'><<<</a>
            </div>
        @endif

        @for($i = $paginateStart; $i < ($paginateStart + $numElements); $i++)
            @if($i <= $paginateMax)
                <div class='col-span-1 flex flex-row justify-center p-3 mb-5 {{ $i === $paginateCurrent ? "bg-yeet-blue text-white" : "" }}'>
                    <a href='{{ route("stocks", ["index" => $index, "page" => ($i - $paginateStart) + 1]) }}'>{{ $i }}</a>
                </div>
            @endif
        @endfor
        
        @if($index < $maxIndex)
            <div class='col-span-1 p-3'>
                <a href='{{ route("stocks", ["index" => $index + 1]) }}'>>>></a>
            </div>
        @endif
    </div>

@endsection
