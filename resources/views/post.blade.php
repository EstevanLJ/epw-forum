@extends('layouts.epw_bulma') 

@section('content')


<div class="columns">
    <div class="column has-text-centered">
        <h1 class="title is-1">{{$post->title}}</h1>
        <h5 class="subtitle is-5">em <a href="{{route('area', $post->area->id)}}">{{$post->area->name}}</a></h5>
    </div>
</div>

<hr>

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
                    <strong><a href="{{$post->author->getUrl()}}">{{$post->author->getFullName()}}</a></strong> {{'@' . $post->author->user_name}} {{getDataDiff($post->created_at)}}
                    <br> 
                    {{$post->text}}
                </p>
            </div>
            {{--  <nav class="level is-mobile">
                <div class="level-left">
                    <a class="level-item">
                        <span class="icon is-small"><i class="fa fa-reply"></i></span>
                    </a>
                    <a class="level-item">
                        <span class="icon is-small"><i class="fa fa-retweet"></i></span>
                    </a>
                    <a class="level-item">
                        <span class="icon is-small"><i class="fa fa-heart"></i></span>
                    </a>
                </div>  --}}
            </nav>
        </div>
    </article>
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
            {{--  <nav class="level is-mobile">
                <div class="level-left">
                    <a class="level-item">
                        <span class="icon is-small"><i class="fa fa-reply"></i></span>
                    </a>
                    <a class="level-item">
                        <span class="icon is-small"><i class="fa fa-retweet"></i></span>
                    </a>
                    <a class="level-item">
                        <span class="icon is-small"><i class="fa fa-heart"></i></span>
                    </a>
                </div>
            </nav>  --}}
        </div>
    </article>
</div>

@endforeach

<hr>
<br>

<div class="columns">
    <div class="column has-text-centered">
        <h3 class="title is-3">Novo Comentário</h3>
    </div>
</div>


<form action="/api/comment" method="POST">
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