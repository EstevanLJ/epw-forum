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


            <div class="columns is-mobile">
                <div class="column is-half is-offset-one-quarter has-text-centered">
                    <h4 class="subtitle is-4">Bem-vindo ao</h4>
                    <h1 class="title is-1">Electrical Power Forum</h1>
                </div>
            </div>

            <div class="columns is-mobile">
                <div class="column is-4 is-offset-4">

                    <form role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                        {{--  Username  --}}
                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                                <input class="input {{ $errors->has('user_name') ? 'is-danger' : '' }}" 
                                    type="text" 
                                    name="user_name" 
                                    value="{{ old('user_name') }}" 
                                    required 
                                    autofocus 
                                    placeholder="Usuário"
                                >
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                @if ($errors->has('user_name'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-warning"></i>
                                    </span>
                                @endif
                            </p>
                            @if ($errors->has('user_name'))
                                <p class="help is-danger">{{ $errors->first('user_name') }}</p>
                            @endif
                        </div>

                        {{--  Password  --}}
                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                                <input class="input {{ $errors->has('password') ? 'is-danger' : '' }}" 
                                    type="password"
                                    name="password"  
                                    placeholder="Senha"
                                    required
                                >
                                <span class="icon is-small is-left">
                                    <i class="fa fa-lock"></i>
                                </span>
                                @if ($errors->has('password'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-warning"></i>
                                    </span>
                                @endif
                            </p>
                            @if ($errors->has('password'))
                                <p class="help is-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        {{--  Remember me  --}}
                        <div class="field">
                            <p class="control">
                                <label class="checkbox">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Lembrar de mim
                                </label>
                            </p>
                        </div>

                        <div class="field">
                            <p class="control ">
                                <button class="button is-primary" type="submit">
                                    Login
                                </button>
                            </p>
                        </div>   
                        <hr style="margin-bottom: 5px">    
                    </form>   
                    
                </div>
            </div>   

            <div class="columns is-mobile" >
                <div class="column is-half is-offset-one-quarter has-text-centered is-paddingless">
                    <p>
                        <a href="#">Você ainda não se registrou?</a>
                    </p>
                    <p>
                        <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                    </p>
                </div>
            </div>  
      

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