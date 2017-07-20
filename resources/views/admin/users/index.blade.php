@extends('layouts.epw_bulma') 

@section('content')

    <h1 class="title is-1 has-text-centered">Painel de Administração - Usuários</h1>

    {{--  <hr>  --}}

    <div class="columns">
    
        <div class="column">
            
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th>Ativo?</th>
                        {{--  <th><abbr title="Points">Pts</abbr></th>  --}}
                        <th>Data de Registro</th>
                        <th>Última Atualização</th>
                        <th class="has-text-centered">Ação</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th>{{$user->id}}</th>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name ? $user->last_name : '-'}}</td>
                            <td>{{$user->user_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->active ? 'Sim' : 'Não'}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->updated_at}}</td>
                            <td>
                                <a class="button is-primary is-outlined is-small" href="{{ route('user.edit', $user->id) }}">
                                    <span class="icon is-small">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                </a>
                                {{--  <a class="button is-danger is-outlined is-small">
                                    <span class="icon is-small">
                                        <i class="fa fa-times"></i>
                                    </span>
                                </a>  --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    
    </div>


    

@endsection