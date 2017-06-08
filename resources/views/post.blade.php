@extends('layouts.epw') 

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="text-center">
                <h1>{{$post->title}}</h1>
                <span>em <a href="{{route('area', $post->area->id)}}">{{$post->area->name}}</a></span>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-sm-3">
            <div class="text-center">
                <img src="{{$post->author->getAvatarUrl()}}" alt="profile" class="img-responsive" style="margin: 0 auto;">
                <hr>
                <h4><a href="{{$post->author->getUrl()}}">{{$post->author->user_name}}</a></h4>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="well">
                <p>{{$post->text}}</p>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <h3>Comentários:</h3>
        </div>
    </div>
    
    <hr>


    @foreach($post->comments as $comment)

        <div class="row">
            <div class="col-sm-3">
                <div class="text-center">
                    <img src="{{$comment->author->getSmallAvatarUrl()}}" alt="profile" class="img-responsive" style="margin: 0 auto;">
                    <hr>
                    <h4><a href="{{$comment->author->getUrl()}}">{{$comment->author->user_name}}</a></h4>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="well">
                    <p>{{$comment->comment}}</p>
                </div>
            </div>
        </div>

        <hr>

    @endforeach


</div>

@endsection