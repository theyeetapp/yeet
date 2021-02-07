
@extends('layouts/app')

@section('title')
    {{ $title }}
@endsection

@section('css')
    <link rel='stylesheet' href='/css/custom-styles.css' />
@endsection

@section('body')
    <div class='w-screen min-h-screen bg-light-gray quicksand'>
        <div class='sidebar h-full bg-yeet-blue flex flex-col py-8 px-5 text-white'>
            <div class='py-5 w-full flex flex-row items-center px-4 mb-12'>
                <i class='relative fa fa-home text-sm mr-5' style='bottom:1px'></i>
                <p class='m-0 text-sm'>yeet</p>
            </div>
            <ul class='text-light-gray px-4'>
                <li class='mb-5 text-sm'>pages</li>
                <li class='flex flex-row items-center mb-8'>
                    <i class='fa fa-check-circle mr-5'></i>
                    <a href='{{ route("subscriptions") }}' class='text-sm'>subscriptions</a>
                </li>
                <li class='flex flex-row items-center mb-8'>
                    <i class='fa fa-coins mr-5'></i>
                    <a href='{{ route("stocks") }}' class='text-sm'>stocks</a>
                </li>
                <li class='flex flex-row items-center mb-8'>
                    <i class='fab fa-bitcoin mr-5'></i>
                    <a href='{{ route("crypto") }}' class='text-sm'>crypto</a>
                </li>
            </ul>
            <ul class='px-4 mb-auto'>
                <li class='mb-5 text-sm'>actions</li>
                <li class='relative flex flex-row items-center mb-8' style='left:1px'>
                    <i class='fa fa-image mr-5'></i>
                    <a href='/' class='text-sm'>change avatar</a>
                </li>
                <li class='relative flex flex-row items-center' style='left:1px'>
                    <i class='fa fa-sign-out-alt mr-5'></i>
                    <form action='{{ route("logout") }}' method='POST'>
                        @CSRF
                        <button type='submit' class='focus:outline-none text-sm'>logout</button>
                    </form>
                </li>
            </ul>
            <div class='pt-4 px-2 flex flex-row justify-center items-center'>
                <img src='{{Auth::user()->avatar ?? "/images/general/user.jpg"}}' class='w-10 h-10 mr-3 rounded-full' />
                <p class='m-0 text-sm'>{{ Auth::user()->name }}</p>
            </div>      
        </div>

        <div class='main flex flex-col px-16'>
            <div class='py-8 flex flex-row justify-between items-center'>
                <div class='flex flex-col'>
                </div>
                <form action='{{ route("search") }}' method='POST' class='relative search-form'>
                    @CSRF
                    <img src='/images/general/search.png' class='absolute top-0 left-0 w-5 h-5 ml-3 mt-3 fa fa-search' style='top:2px; left:2px' />
                    <input type='text' name='symbol' value="{{ $searchTerm ?? '' }}" class='transition-all duration-300 ease-out shadow focus:outline-none w-48 py-3 input-search' />
                </form>
            </div>
            <div class='pt-2 pb-5'>
                @yield('content')
            </div>
        </div>
    </div>

    <div class='update-subscriptions work-sans transition-all duration-300 ease-in fixed left-0 w-screen py-5 px-12 shadow-md bg-white flex flex-row justify-end'>
        <form action='{{ route("subscriptions.update", ["type" => $type]) }}' method='POST'>
            @CSRF
            <input type='hidden' name='subscriptions' class='subscription-symbols' value="">
            <input type='hidden' name='unsubscriptions' class='unsubscription-symbols' value="">
            <input type='hidden' name='types' class='types' value="">
            <input type='hidden' name='companies' class='companies' value="">
            <button type='submit' class='focus:outline-none bg-yeet-blue p-3 text-white'>Update</button>
        </form>
    </div>
@endsection

@section('js')
    <script src='/js/search.js'></script>
    <script>
        const initialSubscriptions = @json($type === "all" ? $symbols : $subscriptions);
        const subscriptions = @json($type === "all" ? $symbols : $subscriptions);
        const unsubscriptions = [];
        const updateSubscriptions = $('.update-subscriptions');
        const companies = {};
        const types = {};
        const actions = $('.action');

        actions.click(function() {
            actionClick($(this));
        })

        const actionClick = action => {

            const check = action.next();
            const symbol = action.parent().parent().find('.symbol').text();
            const name = action.parent().parent().find('.name').text();
            const type = action.parent().parent().find('.type').text();

            if(action.hasClass('action-subscribe')) {
                subscriptions.push(symbol);
                companies[symbol] = name;
                types[symbol] = type;
                const index = unsubscriptions.findIndex(unsubscription => unsubscription === symbol);
                if(index !== -1) {
                    unsubscriptions.splice(index, 1);
                }
                action.removeClass('action-subscribe').addClass('action-unsubscribe');
                action.text('unsubscribe');
                check.addClass('fa-check-circle');
            }
            else {
                const index = subscriptions.findIndex(subscription => subscription === symbol);
                subscriptions.splice(index, 1);
                delete companies[symbol];
                delete types[symbol];
                if(initialSubscriptions.includes(symbol)) {
                    if(!unsubscriptions.includes(symbol)) {
                        unsubscriptions.push(symbol);
                    }
                }
                action.removeClass('action-unsubscribe').addClass('action-subscribe');
                action.text('subscribe');
                check.removeClass('fa-check-circle');
            }

            toggleUpdate();
            updateInputs();
        }

        const toggleUpdate = () => {

            let active = false;

            if(initialSubscriptions.length > 0 && subscriptions.length === 0) {
                active = true;
            }
            if(unsubscriptions.length > 0) {
                active = true;
            }
            else {
                subscriptions.forEach(subscription => {
                    if(!initialSubscriptions.includes(subscription)) {
                        active = true;
                    }
                })
            }

            const set = !active ? updateSubscriptions.removeClass('active') : updateSubscriptions.addClass('active');
        }

        const updateInputs = () => {
            const subscriptionsInput = $('.subscription-symbols');
            const unsubscriptionsInput = $('.unsubscription-symbols');
            const companiesInput = $('.companies');
            const typesInput = $('.types');
            let subscriptionsText = '';
            let unsubscriptionsText = '';
            const subscriptions_ = subscriptions.filter(subscription => !initialSubscriptions.includes(subscription));

            subscriptions_.forEach(subscription => {
                subscriptionsText += subscription + '|';
            })
            
            unsubscriptions.forEach(unsubscription => {
                unsubscriptionsText += unsubscription + '|';
            })

            subscriptionsInput.val(subscriptionsText);
            unsubscriptionsInput.val(unsubscriptionsText);
            companiesInput.val(JSON.stringify(companies));
            typesInput.val(JSON.stringify(types));
        }
    </script>
@endsection