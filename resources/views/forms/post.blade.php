@extends('layouts.epw_bulma') 

@section('content')


<div class="columns">
    <div class="column has-text-centered">
        <h2 class="title is-2">Novo Post</h2>
    </div>
</div>

<hr>

<form action="/api/comment" method="POST">
    {{csrf_field()}}

    <div class="columns">
        <div class="column">
            <div class="field">
                <label class="label">Título</label>
                <p class="control">
                    <input class="input" type="text" name="title" placeholder="Escreva aqui o título">
                </p>
            </div>
        </div>
        <div class="column">
            <div class="field">  
                <label class="label">Área</label>      
                <p class="control">
                    <span class="select is-fullwidth">
                    <select>
                        <option>Selecione a área...</option>

                        @foreach($areas as $area)

                            <option value="{{ $area->id }}">{{ $area->name }}</option>

                        @endforeach

                    </select>
                    </span>
                </p>
            </div>
        </div>
    </div> 

    <div class="field">
        <label class="label">Texto</label>
        <p class="control">
            <textarea class="textarea" name="text"></textarea>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <label class="checkbox">
            <input type="checkbox" required>
                Concordo com as <a href="#">regras do forúm</a>
            </label>
        </p>
    </div>
    <div class="field is-grouped">
        <p class="control">
            <button class="button is-primary">Enviar</button>
        </p>
        <p class="control">
            <button class="button is-link">Cancelar</button>
        </p>
    </div>
</form>


@endsection