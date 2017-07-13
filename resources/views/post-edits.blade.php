@extends('layouts.epw_bulma') 

@section('content')


<div class="columns">
    <div class="column has-text-centered">
        <h1 class="title is-1">{{$post->title}}</h1>
        <h5 class="subtitle is-5">em <a href="{{ $post->area->getUrl() }}">{{$post->area->name}}</a></h5>
    </div>
</div>

<hr>



@if(sizeof($post->edits) > 0)

    <div class="columns">
        <div class="column has-text-centered">
            <h3 class="title is-3">Edições</h3>
        </div>
    </div>

    @foreach($post->edits as $edit)

    <div class="box">
        <article class="media">
            <div class="media-left">
                <figure class="image is-128x128">
                    <img src="{{$edit->author->getSmallAvatarUrl()}}" alt="Image">
                </figure>
            </div>
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong><a href="{{$edit->author->getUrl()}}">{{$edit->author->getFullname()}}</a></strong> <small>{{'@' . $edit->author->user_name}}</small> <small>{{formatDate($edit->date)}}</small>
                        <br> {{$edit->text}}
                    </p>
                </div>
            </div>
        </article>
    </div>

    @endforeach

@endif

<div class="columns">
    <div class="column has-text-centered">
        <h3 class="title is-3">Original</h3>
    </div>
</div>

<div class="box">
    <article class="media">
        <div class="media-left">
            <figure class="image is-128x128">
                <img src="{{$post->author->getSmallAvatarUrl()}}" alt="Image">
            </figure>
        </div>
        <div class="media-content">
            <div class="content">
                <p>
                    <strong><a href="{{$post->author->getUrl()}}">{{$post->author->getFullname()}}</a></strong><small>
                    {{'@' . $post->author->user_name}}</small>
                    <small>{{formatDate($post->created_at)}}</small>
                    <br> {{$post->text}}
                </p>
            </div>
        </div>
    </article>
</div>



<hr>

@endsection