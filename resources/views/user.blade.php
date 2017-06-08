@extends('layouts.epw') 

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="text-center">
                <h1>{{$user->getFullName()}}</h1>
                <hr>
            </div>
        </div>
    </div>   

    <div class="row">
        <div class="col-sm-3">
            <img src="{{$user->getAvatarUrl()}}" alt="profile" class="img-responsive">
        </div>

        <div class="col-sm-9">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Username: {{$user->user_name}}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3>Última atividade: um mês atrás</h3>
                </div>
            </div>

        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-sm-12">

            @if(sizeof($user->posts) > 0)
                <h3>Últimas postagens:</h3>
                <div class="list-group">
                    @foreach($user->posts as $post)
                        <a href="{{$post->getUrl()}}" class="list-group-item">{{$post->title}}</a>
                    @endforeach
                </div>
            @else

                <h3>Nenhuma postagem!</h3>

            @endif

        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">

            @if(sizeof($user->comments) > 0)
                <h3>Últimos comentários:</h3>
                <div class="list-group">
                    @foreach($user->comments as $comment)
                        <a href="#" class="list-group-item">{{limitStringTo($comment->comment, 70)}}</a>
                    @endforeach
                </div>
            @else

                <h3>Nenhum comentário!</h3>

            @endif

        </div>
    </div>



</div>

@endsection