@extends('layouts.epw_bulma') 

@section('content')


<div class="columns">
    <div class="column has-text-centered">
        <h2 class="title is-2">Editar Post</h2>
    </div>
</div>

<hr>

<form action="{{ route('post.update', $post->id) }}" method="POST">
    {{csrf_field()}}

    {{ method_field('PUT') }}

    <div class="columns">
        <div class="column">
            <div class="field">
                <label class="label">Título</label>
                <p class="control">
                    <input class="input" 
                        type="text" 
                        name="title" 
                        placeholder="Escreva aqui o título"
                        value="{{ $post->title }}"
                        disabled
                    >
                </p>
            </div>
        </div>
        <div class="column">
            <div class="field">  
                <label class="label">Área</label>      
                <p class="control">
                    <span class="select is-fullwidth">
                        <select name="area_id" disabled>

                            <option>{{$post->area->name}}</option>

                        </select>
                    </span>
                </p>
            </div>
        </div>
    </div> 

    <div class="field">
        <label class="label">Texto</label>
        <p class="control">
            <textarea class="textarea {{ $errors->has('text') ? 'is-danger' : '' }}" name="text">{{ $post->text }}</textarea>
        </p>
        @if ($errors->has('text'))
            <p class="help is-danger">{{ $errors->first('text') }}</p>
        @endif
    </div>
    <div class="field">
        <p class="control">
            <label class="checkbox">
            <input type="checkbox" name="agree" required {{ old('agree') ? 'checked' : '' }}>
                Concordo com as <a href="{{ route('regras') }}">regras do forúm</a>
            </label>
        </p>
    </div>
    <div class="field is-grouped">
        <p class="control">
            <button class="button is-link" type="submit">Atualizar</button>
        </p>
         <p class="control">
            <a class="button" href="{{ route('post.show', $post->id) }}">Cancelar</a>
        </p> 
    </div>
</form>


@endsection