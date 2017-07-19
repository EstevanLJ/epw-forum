@extends('layouts.epw_bulma') 

@section('content')

    <h1 class="title is-1 has-text-centered">Painel de administração</h1>

    <hr>

    <div class="columns">
    
        <div class="column is-6 is-offset-3">
            <div class="field is-grouped">
                <p class="control">
                    <a class="button is-medium large-button" href="{{ route('user.index') }}">
                        Usuários
                    </a>
                </p>
                <p class="control">
                    <a class="button is-medium large-button">
                        Áreas
                    </a>
                </p>
                <p class="control">
                    <a class="button is-medium large-button">
                        Posts
                    </a>
                </p>
                <p class="control">
                    <a class="button is-medium large-button">
                        Comentários
                    </a>
                </p>
            </div>
        </div>
    
    </div>

    <style>
        .large-button {
            height: 100px;
            width: 150px;
        }
    
    
    </style>

    

@endsection