
@extends('../layouts/app')

@section('title')
    Yeet - Change Password
@endsection

@section('css')
   <link rel="stylesheet" href='/css/auth.css'>
@endsection

@section('body')
<div class='w-screen h-screen flex flex-row justify-center items-center quicksand bg-yeet-blue'>
    <div class='absolute top-0 left-0 w-screen flex text-white pt-12 px-6 bsm:px-10'>
        <p class='m-0 text-lg mr-auto'><a href='{{ route("index") }}'>Yeet</a></p>
        <p class='m-0 text-lg'><a href='{{ route("login") }}'>Login</a></p>
    </div>
        <div class='auth__container flex flex-col'>
            <form noValidate class='relative bg-white rounded p-8' action='{{ route("password.reset") }}' method='POST'>
                @CSRF
                <div class='flex flex-col mt-2 mb-6'>
                    <input type='password' id='password' name='password' class='password focus:outline-none p-3 border' placeholder="Enter your new Password" autofocus>
                    <input type='hidden' name='token' value="{{ $token }}" />
                </div>
                <div class='mb-8'>
                    <button type='submit' class='focus:outline-none hover:bg-yeet-blue transition-colors duration-500 ease-in py-4 text-white bg-yeet-light-blue w-full'>Change Password</button>
                </div>
                <div class='absolute bottom-0 left-0 w-full p-5 rounded' style='background:#F2F2F2'>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src='/js/auth.js'></script>
@endsection