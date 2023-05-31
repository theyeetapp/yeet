<?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\View as ViewFacade;
    use Illuminate\View\View;

    class ViewServiceProvider extends ServiceProvider
    {
        public function register()
        {
            //
        }

        public function boot()
        {
            // ViewFacade::composer(['subscriptions', 'stocks', 'crypto'], function(View $view) {
            //     $subscriptions = Auth::user()->subscriptions;
            //     return $view->with('subscriptions', $subscriptions);
            // });
        }
    }
