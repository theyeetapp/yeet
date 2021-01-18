
@extends('layouts/app')

@section('title')
    Yeet
@endsection

@section('body')
    <div class='work-sans'>
        <div class='h-screen'>
            <div class='h-full grid grid-cols-12'>
                <div class='col-span-5 h-full flex flex-col justify-center text-white px-20 bg-yeet-blue'>
                    <p class='m-0 mb-3 text-xl'>Yeet</p>
                    <p class='text-lg pr-10 mb-4'>
                        financial market monitoring made simple. easily keep track of your stock and crypto-currency portfolios
                    </p>
                    <div class='flex'>
                        <a href='/signup' class='py-5 px-8 text-white shadow-md mr-4' style='width:fit-content'>Signup</a>
                        <a href='/login' class='py-5 px-8 text-white shadow-md' style='width:fit-content'>Login</a>
                    </div>
                </div>
                <div class='col-span-7 relative'>
                    <img src='/images/home/hero.jpg' class='object-cover absolute top-0 left-0 w-full h-full'>
                </div>
            </div>
        </div>
        <div class='py-24 px-64'>
            <div class='grid grid-cols-12 col-gap-5 p-16 bg-white shadow-lg'>
                <div class='col-span-6 flex flex-col justify-center pr-5'>
                    <p class='m-0 mb-5 text-xl font-semibold'>What is Yeet and what can it do for you ?</p>
                    <p class='m-0 text-md leading-7 text-justify'>Yeet is the ultimate tracking tool for your favorite stocks and cryptocurrencies
                    There is simply no need to be checking out stocks or cryptocurrencies you are invested in every day. Instead,
                    have Yeet do that for you. Yeet will deliver the current share price of your favorite stocks and cryptocurrencies
                    every night. Is that convenience or what?</p>
                </div>
                <div class='col-span-6 ml-2'>
                    <img src='/images/home/description.jpg' class='object-cover w-full' style='height:400px'>
                </div>
            </div>
        </div>
        <div class='py-20 px-32 bg-light-gray'>
            <div class='w-full px-8 flex flex-row mb-8'>
                <div class='font-semibold text-xl w-1/2 capitalize pr-10'>
                    Yeet is accompanied by a Telegram bot that delivers share prices of your favorite stocks and cryptocurrencies
                </div>
                <div class='flex flex-col w-1/2 pl-10'>
                    <p class='m-0 mb-5'>YeetBot is an essential component of the automated tracking services Yeet provides. You must register your
                        Telegram contact with him to receive price notifications.
                    </p>
                    <a href='#' class='bg-yeet-blue py-4 px-8 text-white' style='width:fit-content'>YeetBot <i class='ml-2 text-sm fa fa-external-link-alt'></i> </a>
                </div>
            </div>
            <div class='w-full px-8 flex flex-row'>
                <div class='w-1/2 pr-10'>
                    <img src='/images/home/bitcoin.jpg' class='object-cover' style='height:500px'>
                </div>
                <div class='w-1/2 pl-10 flex flex-col'>
                    <div class='flex flex-col mb-4'>
                        <p class='m-0 mb-1 text-lg font-semibold'>1. Create Your Yeet Account</p>
                        <p class='m-0'>Well, as you are here already, create your Yeet account. Or if you do have an account already (you are so smart), login to Yeet.</p>
                    </div>
                    <div class='flex flex-col mb-4'>
                        <p class='m-0 mb-1 text-lg font-semibold'>2. Add Subscriptions</p>
                        <p class='m-0'>From your stocks or cryptocurrencies tabs in Yeet, find stocks you have in your portfolio or simply want to monitor and subscribe to them.</p>
                    </div>
                    <div class='flex flex-col mb-4'>
                        <p class='m-0 mb-1 text-lg font-semibold'>3. Register with YeetBot</p>
                        <p class='m-0'>Visit <a class='text-blue-800' href='#'>t.me/yeetbot</a> or open up your Telegram app and search for YeetBot. Follow its prompts to register your Telegram contact with Yeet.</p>
                    </div>
                    <div class='flex flex-col'>
                        <p class='m-0 mb-1 text-lg font-semibold'>4. Receive your Notifications</p>
                        <p class='m-0'>Every night at 8:00pm, YeetBot via Telegram will send you the market prices of all the stocks and crytocurrencies you are subscribed to.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class='bg-yeet-blue grid grid-cols-12 p-20 text-white'>
            <div class='col-span-4 flex flex-col px-10'>
                <p class='m-0 mb-2 text-xl'>Yeet</p>
                <p class='m-0'>Providing ease in share price tracking and monitoring by leveraging core technologies. Stay updated with your favorite stocks and cryptocurrencies.</p>
            </div>
            <div class='col-start-5 col-span-4 flex flex-col pl-20'>
                <p class='m-0 mb-3 text-xl'>Contact</p>
                <p class='m-0 mb-3'>
                    <i class='fas fa-map-marker-alt mr-3'></i>
                    3, Bisi Awosika street, Ologolo, Lekki
                </p>
                <p class='m-0 mb-3'>
                    <i class='fas fa-phone-alt mr-3'></i>
                    +2348179868840
                </p>
                <p class='m-0'>
                    <i class='fa fa-envelope mr-3'></i>
                    support@yeet.app
                </p>
            </div>
            <div class='col-start-9 col-span-3 pl-24 ml-6 flex flex-col'>
                <p class='m-0 mb-3 text-xl'>Social Media</p>
                <p class='m-0 mb-3'>
                    <i class='fab fa-facebook mr-3'></i>
                    <a href='http://facebook.com' target="blank">Facebook</a>
                </p>
                <p class='m-0 mb-3'>
                    <i class='fab fa-twitter mr-3'></i>
                    <a href='http://twitter.com/f_olamileke' target="_blank">Twitter</a>
                </p>
                <p class='m-0'>
                    <i class='fab fa-instagram mr-4'></i>
                    <a href='http://instagram.com/f_olamileke' target="_blank">Instagram</a>
                </p>
            </div>
        </div>
    </div>
@endsection