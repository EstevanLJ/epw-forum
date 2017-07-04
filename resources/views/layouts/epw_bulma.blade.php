<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EPW Forum</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.2/css/bulma.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>

    @include('layouts.partials.nav_bulma')

    <section class="section">
        <div class="container">
            
            @yield('content')

        </div>
    </div>

    <!--jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.min.js"></script>

    <script>
        axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
    </script>

    @stack('scripts')
    
</body>

</html>