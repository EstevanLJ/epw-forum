<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EPW Forum</title>

    {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.2/css/bulma.min.css">  --}}
    {{--  <link rel="stylesheet" href="/css/bulmaswatch/bulmaswatch.min.css">  --}}
    <link rel="stylesheet" href="https://unpkg.com/bulmaswatch/{{ config('app.theme') }}/bulmaswatch.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>

    <section class="section">
        <div class="container">
            
            <div class="columns">
                <div class="column has-text-centered">
                    <h1 class="title is-1 is-spaced">401</h1>
                    <h5 class="subtitle is-5">Whops! Você não está autorizado.</h5>
                    <a href="{{ route('post.index') }}" class="button is-primary is-outlined">Voltar</a>
                </div>
            </div>

        </div>
    </div>
    
</body>

</html>