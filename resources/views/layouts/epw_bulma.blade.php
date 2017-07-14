<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EPW Forum</title>

    {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.2/css/bulma.min.css">  --}}
    {{--  <link rel="stylesheet" href="/css/bulmaswatch/bulmaswatch.min.css">  --}}
    <link rel="stylesheet" href="/css/bulmaswatch/{{ config('app.theme') }}/bulmaswatch.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.css" />

    @stack('styles')

</head>

<body>

    @include('layouts.partials.nav')

    <section class="section">
        <div class="container">
            
            @yield('content')

        </div>
    </div>

    @include('layouts.partials.footer')

    <!--jQuery-->
    {{-- <script src="/js/plugins/jquery/jquery.min.js"></script> --}}

    {{-- <script src="/js/plugins/axios/axios.min.js"></script> --}}

    {{-- <script>
        axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
    </script> --}}


    @stack('scripts')
    
</body>

</html>