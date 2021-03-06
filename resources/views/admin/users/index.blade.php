@extends('layouts.epw_bulma') 

@section('content')

    <h1 class="title is-1 has-text-centered">Painel de Administração - Usuários</h1>

    {{--  <hr>  --}}

    @if (session('status'))
        <article id="info_message" class="message is-success">
            <div class="message-header">
                <p>Informação</p>
                <button id="info_message_close" class="delete"></button>
            </div>
            <div class="message-body">
                {{session('status')}}
            </div>
        </article>

        <script>
            function closeMessage() {
                document.getElementById('info_message').style.display = 'none';
            }

            document.getElementById('info_message_close').addEventListener('click', function() {
                closeMessage();
            });        

            setTimeout(closeMessage, 2500);
        </script>
    @endif

    <div class="columns">
    
        <div class="column">
            
            <table class="table is-hoverable is-fullwidth">
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
                                <a class="button is-link is-outlined is-small" href="{{ route('user.edit', $user->id) }}">
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
    
    <nav class="pagination is-centered" role="navigation" aria-label="pagination">

        <ul class="pagination-list">

            @if($users->currentPage() != 1)
                <li>
                    <a class="pagination-link" href="{{$users->previousPageUrl()}}"> 
                        <span class="icon is-small">
                            <i class="fa fa-angle-double-left"></i>
                        </span>
                    </a>
                </li>
            @else
                <li>
                    <a class="pagination-link" disabled> 
                        <span class="icon is-small">
                            <i class="fa fa-angle-double-left"></i>
                        </span>
                    </a>
                </li>
            @endif

            @for($i = 1; $i <= ceil($users->total() / $users->perPage()) ; $i++)

                @if($i == $users->currentPage())
                    <li>
                        <a class="pagination-link is-current" href="{{$users->url($i)}}"> 
                            {{$i}}
                        </a>
                    </li>
                @else
                    <li>
                        <a class="pagination-link" href="{{$users->url($i)}}"> 
                            {{$i}}
                        </a>
                    </li>
                @endif                    

            @endfor

            @if($users->hasMorePages())
                <li>
                    <a class="pagination-link" href="{{$users->nextPageUrl()}}"> 
                        <span class="icon is-small">
                            <i class="fa fa-angle-double-right"></i>
                        </span>
                    </a>
                </li>
            @else
                <li>
                    <a class="pagination-link" disabled> 
                        <span class="icon is-small">
                            <i class="fa fa-angle-double-right"></i>
                        </span>
                    </a>
                </li>
            @endif
                
        </ul>

    </nav>
    

@endsection