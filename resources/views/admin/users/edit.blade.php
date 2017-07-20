@extends('layouts.epw_bulma') 

@section('content')

    <h1 class="title is-1 has-text-centered">Editar Usuário</h1>

    {{--  <hr>  --}}

    <div class="columns">
    
        <div class="column is-6 is-offset-3">

            <form action="{{ route('user.update', $user->id) }}" method="POST">
                
                {{csrf_field()}}

                {{ method_field('PUT') }}

                <div class="field">
                    <label class="label">Usuário</label>
                    <div class="control">
                        <input class="input " type="text" value="{{$user->user_name}}" placeholder="Usuário" disabled>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Nome</label>
                    <div class="control">
                        <input class="input {{ $errors->has('first_name') ? 'is-danger' : '' }}" 
                                type="text" name="first_name" value="{{$user->first_name}}" placeholder="Primeiro Nome">
                    </div>
                    @if ($errors->has('first_name'))
                        <p class="help is-danger">{{ $errors->first('first_name') }}</p>
                    @endif
                </div>  

                <div class="field">
                    <label class="label">Sobrenome</label>
                    <div class="control">
                        <input class="input {{ $errors->has('last_name') ? 'is-danger' : '' }}" 
                                type="text" name="last_name" value="{{$user->last_name}}" placeholder="Sobrenome">
                    </div>
                    @if ($errors->has('first_name'))
                        <p class="help is-danger">{{ $errors->first('last_name') }}</p>
                    @endif
                </div>


                <div class="field">
                    <label class="label">E-mail</label>
                    <div class="control">
                        <input class="input {{ $errors->has('email') ? 'is-danger' : '' }}"
                                type="text" name="email" value="{{$user->email}}" placeholder="E-mail">
                    </div>
                    @if ($errors->has('email'))
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="field">  
                    <label class="label">Ativo</label>      
                    <p class="control">
                        <span class="select is-fullwidth {{ $errors->has('active') ? 'is-danger' : '' }}">
                            <select name="active">

                                @if($user->isActive())

                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
        
                                @else

                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>

                                @endif

                            </select>
                        </span>
                    </p>
                    @if ($errors->has('active'))
                        <p class="help is-danger">{{ $errors->first('active') }}</p>
                    @endif
                </div>
                
                <div class="field is-grouped">
                    <p class="control">
                        <button class="button is-primary">Enviar</button>
                    </p>
                    <p class="control">
                        <a class="button" href="{{ route('user.index') }}">Cancelar</a>
                    </p> 
                </div>

            </form> 
            
            
        </div>

    
    </div>


    

@endsection