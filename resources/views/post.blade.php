@extends('layouts.epw_bulma') 

@section('content')


<div class="columns">
    <div class="column has-text-centered">
        <h1 class="title is-1">{{$post->title}}</h1>
        <h5 class="subtitle is-5">em <a href="{{ $post->area->getUrl() }}">{{$post->area->name}}</a> {{getDataDiff($post->created_at)}}</h5>
    </div>
</div>

@if($errors->has('message'))
    <article id="error_messages" class="message is-warning">
        <div class="message-header">
            <p>Alerta</p>
            <button id="error_messages_close" class="delete"></button>
        </div>
        <div class="message-body">
            {{$errors->first('message')}}
        </div>
    </article>

    <script>
        document.getElementById('error_messages_close').addEventListener('click', function() {
            document.getElementById('error_messages').style.display = 'none';
        });
    
    </script>
@endif

<hr>

@can('update', $post)

    <div class="columns">
        <div class="column is-one-third">
            <p>Você criou esse post em {{formatDate($post->created_at)}}</p>            
        </div>
        <div class="column is-one-third">
            @if($post->wasEdited())
                <p>O post foi editado em {{formatDate($post->updated_at)}}</p>
            @endif      
        </div>
        <div class="column">
            <div class="block is-pulled-right">

                @if($post->isArchived())
                    <a class="button is-link" disabled>Editar Post</a>
                    <a class="button is-warning" disabled>Arquivar Post</a>
                @else
                    <a class="button is-link" href="{{ route('post.edit', $post->id) }}">Editar Post</a>
                    <a id="archive_post_button" class="button is-warning">Arquivar Post</a>
                @endif

            </div>
        </div>
    </div>

    <form id="archive_post_form" action="{{ route('post.archive', $post->id) }}" method="POST">
        {{csrf_field()}}
        {{ method_field('DELETE') }}    
    </form>

    @push('scripts')

    <script src="/js/partials/post.js"></script>

    @endpush


    <hr>

@endif

@if($post->isArchived())

    <div class="columns">
        <div class="column">
            <article class="message is-warning">
                <div class="message-body has-text-centered">
                    <h3 class="title is-3">Post Arquivado</h3>
                    <p>
                        Esse post foi arquivado por 
                        <strong><a href="{{$post->author->getUrl()}}">{{$post->archivedBy->getFullName()}}</a></strong> 
                        no dia {{formatDate($post->archived_date)}}
                        @if($post->archived_comment)
                            , com o seguinte comentário: {{ $post->archived_comment }}
                        @endif                    
                    </p> 
                </div>
            </article>
        </div>
    </div>


    <hr>

@endif

{{--  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="box">
            <article class="media">
                <div class="media-content">
                    <div class="content has-text-centered">
                        <h3 class="title is-3">Você tem certeza disso?</h3>
                        <div class="block">
                            <a class="button is-danger">Arquivar</a>
                            <a class="button">Cancelar</a>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
    <button class="modal-close is-large"></button>
</div>  --}}

<div class="box">
    <article class="media">
        <div class="media-left">
            <figure class="image is-256x256">
                <img src="{{$post->author->getAvatarUrl()}}" alt="Image">
            </figure>
        </div>
        <div class="media-content">
            <div class="content">
                <p>
                    <strong><a href="{{$post->author->getUrl()}}">{{$post->author->getFullName()}}</a></strong>
                    {{'@' . $post->author->user_name}} 

                    @if($post->wasEdited())
                        <a href="{{ route('post.history', $post->id)}}">editado</a>
                    @endif
                    <br> 
                    {{$post->getLastText()}}
                </p>
            </div>
            </nav>
        </div>
    </article>
</div>


@if($post->getCommentsCount() > 0)

    <div class="columns">
        <div class="column">
            <h3 class="subtitle is-3">{{$post->getCommentsCount()}} Comentário{{$post->getCommentsCount() > 1 ? 's' : ''}}</h3>
        </div>
        @if($post->visualizations > 1)
            <div class="column">
                <a class="button is-link is-static is-outlined is-pulled-right">
                    {{$post->visualizations}} visualizações
                </a>
            </div>
        @endif
    </div>

    <hr>

    @foreach($post->comments as $comment)

    <div class="box">
        <article class="media">
            <div class="media-left">
                <figure class="image is-128x128">
                    <img src="{{$comment->author->getSmallAvatarUrl()}}" alt="Image">
                </figure>
            </div>
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong><a href="{{$comment->author->getUrl()}}">{{$comment->author->getFullname()}}</a></strong> <small>{{'@' . $comment->author->user_name}}</small> <small>{{getDataDiff($comment->created_at)}}</small>
                        <br> {{$comment->comment}}
                    </p>
                </div>
            </div>
        </article>
    </div>

    @endforeach

@endif

<hr>
<br>

@if(Auth::user()->can('create', \App\Comment::class) && !$post->isArchived())

    <div class="columns">
        <div class="column has-text-centered">
            <h3 class="title is-3">Novo Comentário</h3>
        </div>
    </div>

    <form action="/comment" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <div class="field">
            <label class="label">Comentário</label>
            <p class="control">
                <textarea class="textarea" placeholder="Escreva aqui o seu comentário" name="comment"></textarea>
            </p>
        </div>
        <div class="field">
            <p class="control">
                <label class="checkbox">
                <input type="checkbox" required>
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
@endunless


@endsection


@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.js"></script>

@endpush



@push('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.css" />

<style>

    .extra-padding-left {
        margin-right: 30px;
    }

</style>

@endpush