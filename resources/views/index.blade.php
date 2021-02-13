
@extends('layouts/app')

@section('css')

    <style>
        .hero
        {
            height:100vh;
        }

        .services-image
        {
            height:410px;
        }

        .setup-image
        {
            height:570px;
        }

        .bot-image 
        {
            height:550px;
        }

        @media(max-width:1025px)
        {
            .hero
            {
                height:60vh;
            }
        }

        @media(max-width:810px)
        {
            .bot-image
            {
                height:450px;
            }
        }

        @media(max-width:769px) 
        {
            .services-image
            {
                height:400px;
            }

            .bot-image
            {
                height:400px;
            } 

            .setup-image
            {
                height:500px;
            }
        }

        @media(max-width:576px)
        {
            .hero
            {
                height:70vh;
            }
        }
    </style>
@endsection

@section('title')
    Yeet
@endsection

@section('body')
    <div class='quicksand'>
        <div class='hero grid grid-cols-12'>
            <div class='col-span-12 lg:col-span-5 h-full flex flex-col justify-center text-white px-10 sm:px-12 bsm:px-24 bg-yeet-blue'>
                <p class='m-0 sm:ml-2 bsm:ml-0 mb-3 text-xl'>Yeet</p>
                <div class='text-md sm:ml-2 bsm:ml-0 pr-10 mb-4'>
                    financial market monitoring made simple. <p class='m-0 hidden sm:inline'>easily keep track of your stock and crypto-currency portfolios</p>
                </div>
                <div class='flex sm:ml-2 bsm:ml-0'>
                    <a href='{{ route("signup") }}' class='py-4 px-6 text-white text-md shadow mr-4' style='width:fit-content'>signup</a>
                    <a href='{{ route("login") }}' class='py-4 px-6 text-white text-md shadow' style='width:fit-content'>login</a>
                </div>
            </div>
            <div class='hidden lg:block col-span-7 relative'>
                <img src='/images/home/hero.jpg' class='object-cover absolute top-0 left-0 w-full h-full'>
            </div>
        </div>
        <div class='sm:pt-24 px-6 sm:px-16 md:px-24 lg:px-64'>
            <div class='flex flex-col-reverse bmd:grid bmd:grid-cols-12 col-gap-5 px-5 sm:px-10 py-10 bmd:p-16 bg-white sm:shadow-md'>
                <div class='w-full bmd:col-span-6 flex flex-col justify-center lowercase bmd:pr-5'>
                    <p class='m-0 mb-4 bmd:mb-5 text-lg text-center bmd:text-left font-semibold'>What is Yeet and what can it do for you</p>
                    <p class='m-0 text-base leading-7 text-justify'>Yeet is the ultimate tracking tool for your favorite stocks and crypto. with 
                    over 2000 stocks and 3000 crytocurrencies available always be aware of the current state of your investment or stocks portfolio.
                    With Yeet, there is simply no need to be checking out stocks or cryptocurrencies you are interested in by yourself every day. Instead,
                    have Yeet do that for you. Yeet will deliver the current share price of your favorite stocks and crypto
                    every night. Is that convenience or what?</p>
                </div>
                <div class='hidden sm:block w-full bmd:col-span-6 mb-6 bmd:mb-0 bmd:ml-2'>
                    <img src='/images/home/description.jpg' class='services-image object-cover w-full'>
                </div>
            </div>
        </div>
        t<div class='grid grid-cols-12 px-6 sm:px-16 md:px-24 bmd:px-6 py-20 sm:mt-16 bmd:my-24 bg-yeet-blue text-white'>
            <div class='h-full hidden bmd:flex col-start-2 col-end-6 flex-col justify-center'>
                <p class='m-0 mb-3 text-xl'>YeetBot</p>
                <p class='m-0 mb-5 leading-7 text-justify'>Yeet is equiped with a powerful Telegram bot named YeetBot through which users receive price notifications. An essential component of
                the automated stock and cryptocurrency tracking services provided by Yeet, user Telegram information
                must be registered with him. Every night at 8:00 PM, he delivers roundups of all stocks and cryptocurrencies you are subscribed to.</p>
                <a href='{{ route("signup") }}' class='py-4 px-6 text-white text-md shadow-md mr-4' style='width:fit-content'>YeetBot <i class='ml-2 text-sm fa fa-external-link-alt'></i></a>
            </div>
            <div class='hidden sm:block relative col-span-12 mb-8 bmd:mb-0 bmd:col-start-7 bmd:col-end-12'>
                <img src='/images/home/bot.jpg' class='w-full object-cover bot-image'>
                <div class='absolute top-0 left-0 w-full h-full' style='background:rgba(0,0,0,0.1)'></div>
            </div>
            <div class='px-5 sm:px-0 h-full bmd:hidden col-span-12 flex flex-col items-center justify-center'>
                <p class='m-0 mb-3 text-xl'>YeetBot</p>
                <p class='m-0 mb-3 leading-7 text-justify'>Yeet is equiped with a powerful Telegram bot named YeetBot through which users receive price notifications. An essential component of
                the automated stock and cryptocurrency tracking services provided by Yeet, user Telegram information
                must be registered with him. Every night at 8:00 PM, he delivers roundups of all stocks and cryptocurrencies you are subscribed to.</p>
                <a href='{{ route("signup") }}' class='py-4 px-6 text-white text-md shadow-md mr-4' style='width:fit-content'>YeetBot <i class='ml-2 text-sm fa fa-external-link-alt'></i></a>
            </div>
        </div>
        <div class='py-8 sm:py-12 md:py-20 px-8 sm:px-12 md:px-20 lg:pl-32 lg:pr-24 bg-light-gray'>
            <div class='w-full bmd:px-8 flex flex-col lg:flex-row'>
                <div class='w-full mb-10 lg:mb-0 lg:w-1/2 lg:pr-10'>
                    <img src='/images/home/bitcoin.jpg' class='object-cover setup-image'>
                </div>
                <div class='w-full text-justify sm:text-left lg:w-1/2 lg:pl-10 flex flex-col'>
                    <div class='mb-4'>
                        <p class='m-0'>Getting started with yeet is very easy. Easy like counting 1, 2, 3, 4. Follow the steps below
                        and in no time you will be enjoying the convenience Yeet provides.</p>
                    </div>
                    <div class='flex flex-col mb-4'>
                        <p class='m-0 mb-2 bmd:mb-1 text-center sm:text-left text-md font-semibold'>1. Create Your Yeet Account</p>
                        <p class='m-0'>Well, as you are here already, create your Yeet account. Or if you do have an account already (you are so smart), login to Yeet.</p>
                    </div>
                    <div class='flex flex-col mb-4'>
                        <p class='m-0 mb-2 bmd:mb-1 text-center sm:text-left text-md font-semibold'>2. Add Subscriptions</p>
                        <p class='m-0'>From your stocks or cryptocurrencies tabs in Yeet, find stocks you have in your portfolio or simply want to monitor and subscribe to them.</p>
                    </div>
                    <div class='flex flex-col mb-4'>
                        <p class='m-0 mb-2 bmd:mb-1 text-center sm:text-left text-md font-semibold'>3. Register with YeetBot</p>
                        <p class='m-0'>Visit <a class='text-blue-800' href='#'>t.me/yeetbot</a> or open up your Telegram app and search for YeetBot. Follow its prompts to register your Telegram contact with Yeet.</p>
                    </div>
                    <div class='flex flex-col'>
                        <p class='m-0 mb-2 bmd:mb-1 text-center sm:text-left text-md font-semibold'>4. Receive your Notifications</p>
                        <p class='m-0'>Every night at 8:00pm, YeetBot via Telegram will send you the market prices of all the stocks and crytocurrencies you are subscribed to.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class='bg-yeet-blue grid grid-cols-12 py-12 bsm:py-20 px-10 lg:p-20 text-white'>
            <div class='col-span-12 mb-4 bsm:mb-0 bsm:col-span-4 flex flex-col bsm:pl-5 bmd:pl-10 lg:px-10'>
                <p class='m-0 mb-2 text-xl'>Yeet</p>
                <div>Providing ease in share price tracking and monitoring by leveraging core technologies. <p class='m-0 hidden bmd:inline'>Stay updated with your favorite stocks and cryptocurrencies.</p></div>
            </div>
            <div class='col-span-12 mb-4 bsm:mb-0 bsm:col-start-5 bsm:col-span-5 flex flex-col bsm:pl-12 lg:pl-24'>
                <p class='m-0 mb-2 bsm:mb-3 text-xl'>Contact</p>
                <p class='m-0 mb-2 bsm:mb-3'>
                    <i class='fas fa-map-marker-alt mr-3'></i>
                    3, Bisi Awosika street, Ologolo, Lekki
                </p>
                <p class='m-0 mb-2 bsm:mb-3'>
                    <i class='fas fa-phone-alt mr-3'></i>
                    +2348179868840
                </p>
                <p class='m-0'>
                    <i class='fa fa-envelope mr-3'></i>
                    <a href='mailto:olamileke.dev@gmail.com'>olamileke.dev@gmail.com</a>
                </p>
            </div>
            <div class='col-span-12 bsm:col-start-10 bsm:col-span-3 lg:pl-12 bsm:ml-3 flex flex-col'>
                <p class='m-0 mb-2 bsm:mb-3 text-xl'>Socials</p>
                <p class='m-0 mb-2 bsm:mb-3'>
                    <i class='fab fa-facebook mr-3'></i>
                    <a href='http://facebook.com' target="blank">Facebook</a>
                </p>
                <p class='m-0 mb-2 bsm:mb-3'>
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