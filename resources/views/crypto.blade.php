
@extends('layouts/auth_app')

@section('content')

    <div class='grid grid-cols-12 col-gap-5 mb-5'>
        @foreach($crypto as $currency)
            <div class='col-span-4 bg-white flex flex-col mb-5 p-5 shadow'>
                <p class='m-0 mb-3'>{{ array_keys($currency)[0] }}</p>
                <p class='m-0 mb-3 text-sm'>{{  strlen(array_values($currency)[0]) > 40 ? substr(array_values($currency)[0], 0, 37) . '...' : array_values($currency)[0] }}</p>
                <div class='flex flex-row justify-between items-center'>
                    <p class='m-0 cursor-pointer text-sm'>subscribe</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class='w-full grid grid-cols-12 col-gap-5'>
        @if($index > 1)
        <div class='col-span-1 p-3'>
            <a href='{{ route("crypto", ["index" => $index - 1]) }}'><<<</a>
        </div>
        @endif

        @for($i = $paginate_start; $i <= ($paginate_start + config('app.elements_per_page')); $i++)
            <div class='col-span-1 flex flex-row justify-center p-3 mb-5 {{ $i === $paginate_current ? "bg-yeet-blue text-white" : "" }}'>
                <a href='{{ route("stocks", ["index" => $index, "page" => ($i - $paginate_start) + 1]) }}'>{{ $i }}</a>
            </div>
        @endfor
        <div class='col-span-1 p-3'>
            <a href='{{ route("crypto", ["index" => $index + 1]) }}'>>>></a>
        </div>
    </div>
@endsection