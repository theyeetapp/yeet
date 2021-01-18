
@extends('../layouts/app')

@section('title')
    Yeet - Signup
@endsection

@section('css')
   <link rel="stylesheet" href='/css/auth.css'>
@endsection

@section('body')
    <div class='w-screen h-screen flex flex-row justify-center items-center work-sans bg-yeet-blue'>
        <div class='absolute top-0 left-0 w-screen flex text-white pt-12 px-6 bsm:px-10'>
            <p class='m-0 text-lg mr-auto'><a href='/'>Yeet</a></p>
            <p class='m-0 text-lg'><a href='/login'>Login</a></p>
        </div>
        <div class='auth__container flex flex-col'>
            <form class='relative bg-white rounded p-8' action='/signup' method='POST'>
                @CSRF
                <div class='flex flex-col mb-4'>
                    <label for='name' class='text-gray-800 mb-2'>Name</label>
                    <input type='text' id='name' class='focus:outline-none p-3 border' placeholder="Full Name">
                </div>
                <div class='flex flex-col mb-4'>
                    <label for='email' class='text-gray-800 mb-2'>Email</label>
                    <input type='email' id='email' class='focus:outline-none p-3 border' placeholder="Email">
                </div>
                <div class='flex flex-col mb-6'>
                    <label for='email' class='text-gray-800 mb-2'>Password</label>
                    <input type='password' id='password' class='focus:outline-none p-3 border' placeholder="Password">
                </div>
                <div class='mb-4'>
                    <button type='submit' class='hover:bg-yeet-blue transition-colors duration-500 ease-in py-4 text-white bg-yeet-light-blue w-full'>Signup to Yeet</button>
                </div>
                <div class='mb-10'>
                    <p class='m-0 text-sm text-gray-700 text-center'>signup with <a href='' class='text-blue-700'>Google</a> instead</p>
                </div>
                <div class='absolute bottom-0 left-0 w-full p-5 rounded' style='background:#F2F2F2'>
                    <p class='m-0 text-sm text-gray-700 text-center'>already have an account? <a href='/login' class='text-blue-700'>login</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection