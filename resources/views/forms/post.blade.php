@extends('layouts.epw_bulma') 

@section('content')


<div class="columns">
    <div class="column has-text-centered">
        <h2 class="title is-2">Novo Post</h2>
    </div>
</div>

<hr>

<form action="/post" method="POST">
    {{csrf_field()}}

    <div class="columns">
        <div class="column">
            <div class="field">
                <label class="label">Título</label>
                <p class="control has-icons-right">
                    <input class="input {{ $errors->has('title') ? 'is-danger' : '' }}" 
                        type="text" 
                        name="title" 
                        placeholder="Escreva aqui o título"
                        value="{{ old('title') }}"
                        >
                    @if ($errors->has('title'))
                        <span class="icon is-small is-right">
                            <i class="fa fa-warning"></i>
                        </span>
                    @endif
                </p>
                @if ($errors->has('title'))
                    <p class="help is-danger">{{ $errors->first('title') }}</p>
                @endif
            </div>
        </div>
        <div class="column">
            <div class="field">  
                <label class="label">Área</label>      
                <p class="control">
                    <span class="select is-fullwidth {{ $errors->has('area_id') ? 'is-danger' : '' }}">
                    <select name="area_id">

                        <option>Selecione a área...</option>

                        @foreach($areas as $area)

                            <option value="{{ $area->id }}" {{ old('area_id') ==  $area->id ? 'selected' : '' }}>{{ $area->name }}</option>

                        @endforeach

                    </select>
                    </span>
                </p>
                @if ($errors->has('area_id'))
                    <p class="help is-danger">{{ $errors->first('area_id') }}</p>
                @endif
            </div>
        </div>
    </div> 

    <div class="field">
        <label class="label">Texto</label>
        <p class="control">
            <textarea class="textarea" name="text">{{ old('text') }}</textarea>
        </p>
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
            <button class="button is-link">Enviar</button>
        </p>
        {{--  <p class="control">
            <button class="button is-link">Cancelar</button>
        </p>  --}}
    </div>
</form>


@endsection