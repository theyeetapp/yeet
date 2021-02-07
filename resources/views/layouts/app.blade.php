<!DOCTYPE html>
<html lang="en">    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#FBFBFB" />
        <meta
        name="yeet" 
        content="stocks and crypto tracking made easy"
        />
        <title>@yield('title')</title>
        <link rel="icon" href="/images/general/favicon.png" />
        <link rel='stylesheet' href='/css/styles.css'>
        <link rel='stylesheet' href='/css/notify.css'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css' rel="stylesheet">
        <link href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css' rel="stylesheet">
        <link href='https://fonts.googleapis.com/css2?family=Quicksand&display=swap' rel="stylesheet">
        <link href='https://fonts.googleapis.com/css2?family=Work+Sans&display=swap' rel="stylesheet">
        @yield('css')
    </head>
    <body class='overflow-x-hidden'>
        @yield('body')

        <script src='/js/jquery.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'></script>
        <script>
            $(document).ready(() => {
                @if(Session::has('message'))
                    toastr.success("{{ Session::get('message') }}")
                @endif

                @if(Session::has('error'))
                    toastr.error("{{ Session::get('error') }}")
                @endif
            })
        </script>
        @yield('js')
    </body>
</html>