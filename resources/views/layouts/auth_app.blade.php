
@extends('layouts/app')

@section('title')
    {{ $title }}
@endsection

@section('css')
    <link rel='stylesheet' href='/css/custom-styles.css' />
    @if($type === 'all' || $type === 'search')
        <link rel='stylesheet' href='/css/subscriptions.css' />
    @endif
@endsection

@section('body')
    <div class='w-screen min-h-screen bg-light-gray quicksand'>
        <div class='sidebar h-full bg-yeet-blue flex flex-col justify-between py-10 sm:py-10 lg:py-8 text-white'>
            <div class='sm:py-5 w-full flex flex-row items-center px-8 sm:px-12 md:px-16 lg:px-8'>
                <i class='relative fa fa-home text-sm mr-5' style='bottom:1px'></i>
                <p class='relative m-0 text-md' style='bottom:1px;'>yeet</p>
            </div>
            <div class='flex flex-col'>
                <ul class='text-light-gray mb-4 xs:mb-6'>
                    <li class='mb-5 text-sm px-8 sm:px-12 md:px-16 lg:px-8'>pages</li>
                    <li class='flex flex-row items-center mb-2 xs:mb-2 py-2 xs:py-3 px-8 sm:px-12 md:px-16 lg:px-8 {{ $type === "all" || $type === "search" ? "active-link" : "" }}'>
                        <i class='fa fa-check-circle mr-5'></i>
                        <a href='{{ route("subscriptions") }}' class='text-sm'>subscriptions</a>
                    </li>
                    <li class='flex flex-row items-center mb-2 xs:mb-2 py-2 xs:py-3 px-8 sm:px-12 md:px-16 lg:px-8 {{ $type === "stock" ? "active-link" : "" }}'>
                        <i class='fa fa-coins mr-5'></i>
                        <a href='{{ route("stocks") }}' class='text-sm'>stocks</a>
                    </li>
                    <li class='flex flex-row items-center py-2 xs:py-3 px-8 sm:px-12 md:px-16 lg:px-8 {{ $type === "crypto" ? "active-link" : "" }}'>
                        <i class='fab fa-bitcoin mr-5'></i>
                        <a href='{{ route("crypto") }}' class='text-sm'>crypto</a>
                    </li>
                </ul>
                <ul class='px-8 sm:px-12 md:px-16 lg:px-8'>
                    <li class='mb-5 text-sm'>actions</li>
                    <li class='relative flex flex-row items-center mb-4 xs:mb-8' style='left:1px'>
                        <i class='relative fa fa-robot mr-4' style='left:-2px'></i>
                        <a href='https://t.me/theyeetbot' target='_blank' class='m-0 text-sm cursor-pointer'>yeetbot</a>
                    </li>
                    <li class='relative flex flex-row items-center mb-4 xs:mb-8' style='left:1px'>
                        <i class='fa fa-image mr-5'></i>
                        <p class='m-0 text-sm change-avatar cursor-pointer'>change avatar</p>
                    </li>
                    <li class='relative flex flex-row items-center avatar-form-parent hidden mb-4 xs:mb-8' style='left:1px'>
                        <form action='{{ route("avatar.update") }}' method='POST' enctype='multipart/form-data'>
                            @CSRF
                            <input type='file' name='avatar' class='hidden' />
                            <button type='submit' class='focus:outline-none outline-none flex items-center bg-transparent text-sm'>
                                <i class='fa fa-arrow-circle-up mr-5 text-base'></i> <p class='m-0'>update</p>
                            </button>
                        </form>
                    </li>
                    <li class='relative flex flex-row items-center' style='left:1px'>
                        <i class='fa fa-sign-out-alt mr-5'></i>
                        <form action='{{ route("logout") }}' method='POST'>
                            @CSRF
                            <button type='submit' class='focus:outline-none text-sm'>logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            <div class='pt-4 flex flex-row lg:justify-center items-center px-8 sm:px-12 md:px-16 lg:px-8'>
                <img src='{{ Auth::user()->avatar ? Auth::user()->avatar->url : "https://res.cloudinary.com/olamileke/image/upload/v1671135774/yeet/assets/icons/DefaultAvatar_olhkwo.png" }}' class='avatar object-cover w-10 h-10 mr-3 rounded-full' />
                <p class='m-0 text-sm'>{{ Auth::user()->name }}</p>
            </div>      
        </div>

        <div class='main flex flex-col px-8 sm:px-16'>
            <div class='py-8 sm:mt-3 md:mt-5 lg:mt-0 flex flex-row justify-between items-center'>
                <div class='nav-toggle lg:invisible flex flex-col p-4 bg-yeet-blue'>
                    <i class='fa fa-bars text-white'></i>
                </div>
                <form action='{{ route("search") }}' method='POST' class='relative search-form'>
                    @CSRF
                    <img src='https://res.cloudinary.com/olamileke/image/upload/v1671135774/yeet/assets/icons/search_mr95t7.png' class='absolute top-0 left-0 w-5 h-5 ml-3 mt-3 fa fa-search' style='top:2px; left:2px' />
                    <input type='text' name='symbol' value="{{ $searchTerm ?? '' }}" class='transition-all duration-300 ease-out shadow focus:outline-none w-48 py-3 input-search' />
                </form>
            </div>
            <div class='pt-2 pb-5'>
                @yield('content')
            </div>
        </div>
    </div>

    <div class='blocker'>
    </div>

    <div class='update-subscriptions work-sans transition-all duration-300 ease-in fixed left-0 w-screen py-4 px-4 lg:px-8 shadow-md bg-white flex flex-row justify-end'>
        <form action='{{ route("subscriptions.update", ["type" => $type]) }}' method='POST'>
            @CSRF
            <input type='hidden' name='subscriptions' class='subscription-symbols' value="">
            <input type='hidden' name='unsubscriptions' class='unsubscription-symbols' value="">
            <input type='hidden' name='types' class='types' value="">
            <button type='submit' class='focus:outline-none bg-yeet-blue p-2 md:p-3 text-white'>Update</button>
        </form>
    </div>
@endsection

@section('js')
    <script src='/js/search.js'></script>
    <script src='/js/toggle-sidebar.js'></script>
    <script src='/js/update-avatar.js'></script>
    <script>
        const initialSubscriptions = @json($type === "all" ? $symbols : $subscriptions);
        const subscriptions = @json($type === "all" ? $symbols : $subscriptions);
        const unsubscriptions = {};
        const updateSubscriptions = $('.update-subscriptions');
        const types = {};
        const actions = $('.action');

        const actionClick = action => {

            const check = action.next();
            const symbol = action.parent().parent().find('.symbol').text();
            const name = action.parent().parent().find('.name').text();
            const type = action.parent().parent().find('.type').text();

            if(action.hasClass('action-subscribe')) {
                subscriptions[name] = symbol;
                types[name] = type;
                if(unsubscriptions[name]) {
                    delete unsubscriptions[name];
                }
                action.removeClass('action-subscribe').addClass('action-unsubscribe');
                action.text('unsubscribe');
                check.addClass('fa-check-circle');
            }
            else {
                delete subscriptions[name];
                delete types[name];
                if(initialSubscriptions[name]) {
                    if(!unsubscriptions[name]) {
                        unsubscriptions[name] = symbol;
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
            if(Object.keys(initialSubscriptions).length > 0 && Object.keys(subscriptions).length === 0) {
                active = true;
            }
            else if(Object.keys(unsubscriptions).length > 0) {
                active = true;
            }
            else {
                Object.keys(subscriptions).forEach(comapany => {
                    if(!Object.keys(initialSubscriptions).includes(comapany)) {
                        active = true;
                    }
                })
            }

            const set = !active ? updateSubscriptions.removeClass('active') : updateSubscriptions.addClass('active');
        }

        const updateInputs = () => {
            const subscriptionsInput = $('.subscription-symbols');
            const unsubscriptionsInput = $('.unsubscription-symbols');
            const typesInput = $('.types');
            let subscriptionsText = '';
            let unsubscriptionsText = '';
            const initialSubscriptionCompanies = Object.keys(initialSubscriptions);
            const subscriptions_ = {};
            Object.keys(subscriptions)
            .filter(company => !initialSubscriptionCompanies.includes(company))
            .forEach(company => {
                subscriptions_[company] = subscriptions[company];
            })

            subscriptionsInput.val(JSON.stringify(subscriptions_));
            unsubscriptionsInput.val(JSON.stringify(unsubscriptions));
            typesInput.val(JSON.stringify(types));
        }

        actions.click(function() {
            actionClick($(this));
        })
    </script>
@endsection