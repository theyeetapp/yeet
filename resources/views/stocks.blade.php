
@extends('layouts/auth_app')

@section('content')

    <div class='grid grid-cols-12 col-gap-5 mb-5'>
        @foreach($stocks as $stock)
            <div class='col-span-4 bg-white flex flex-col mb-5 p-5 shadow'>
                <p class='m-0 mb-3 symbol'>{{ $stock->symbol }}</p>
                <p class='m-0 mb-3 text-sm name'>{{  strlen($stock->company) > 40 ? substr($stock->company, 0, 37) . '...' : $stock->company }}</p>
                <div class='flex flex-row justify-between items-center'>
                    <p class='m-0 cursor-pointer text-sm action {{ in_array($stock->symbol, $subscriptions) ? "action-unsubscribe" : "action-subscribe" }}'>
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
        @if($index > 1)
        <div class='col-span-1 p-3'>
            <a href='{{ route("stocks", ["index" => $index - 1]) }}'><<<</a>
        </div>
        @endif

        @for($i = $paginate_start; $i <= ($paginate_start + config('app.elements_per_page')); $i++)
            <div class='col-span-1 flex flex-row justify-center p-3 mb-5 {{ $i === $paginate_current ? "bg-yeet-blue text-white" : "" }}'>
                <a href='{{ route("stocks", ["index" => $index, "page" => ($i - $paginate_start) + 1]) }}'>{{ $i }}</a>
            </div>
        @endfor
        <div class='col-span-1 p-3'>
            <a href='{{ route("stocks", ["index" => $index + 1]) }}'>>>></a>
        </div>
    </div>

    <div class='update-subscriptions transition-all duration-300 ease-in fixed left-0 w-screen py-6 px-12 shadow-md bg-white flex flex-row justify-end'>
        <form action='' method='POST'>
            @CSRF
            <input type='hidden' name='subscriptions' class='subscriptions-input' value="{{ $subscriptionString }}">
            <input type='hidden' name='unsubscriptions' class='unsubscriptions-input' value="">
            <button type='submit' class='focus:outline-none bg-yeet-blue p-3 text-white'>Update</button>
        </form>
    </div>
@endsection

@section('js')
    <script>
        const initialSubscriptions = @json($subscriptions);
        const subscriptions = @json($subscriptions);
        const unsubscriptions = [];
        const updateSubscriptions = $('.update-subscriptions')
        const actions = $('.action');

        actions.click(function() {
            actionClick($(this));
        })

        const actionClick = action => {

            const check = action.next();
            const symbol = action.parent().parent().find('.symbol').text();

            if(action.hasClass('action-subscribe')) {
                subscriptions.push(symbol);
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
            const subscriptionsInput = $('.subscriptions-input');
            const unsubscriptionsInput = $('.unsubscriptions-input');
            let subscriptionsText = '';
            let unsubscriptionsText = '';
            const subscriptions_ = subscriptions.filter(subscription => !initialSubscriptions.includes(subscription));
            // const unsubscriptions_ = unsubscriptions.filter(unsubscription => !initialSubscriptions.includes(unsubcription));

            subscriptions_.forEach(subscription => {
                subscriptionsText += subscription + '|';
            })
            
            unsubscriptions.forEach(unsubscription => {
                unsubscriptionsText += unsubscription + '|';
            })

            alert(subscriptionsText);
            alert(unsubscriptionsText);
        }
    </script>
@endsection