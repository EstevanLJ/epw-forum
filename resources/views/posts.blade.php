@extends('layouts.epw') 

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="text-center">
                <h1>{{isset($area) ? $area->name . ' - ' : ''}}Últimas postagens</h1>
                <hr>
            </div>
        </div>
    </div>

    {{-- Padrão --}}
    {{-- <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-6">
                    <strong>O que é um gerador?</strong> <small>Geradores</small>
                </div>
                <div class="col-lg-6">
                    <div class="pull-right">
                        por <a href="#">estevan.junes</a> à 3 horas
                        <span class="text-primary">12 <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></span>
                        <span class="text-success">10 <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></span>
                        <span class="text-danger">5 <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></span>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    @foreach($posts as $post)

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <strong><a href="{{$post->getUrl()}}">{{$post->title}}</a></strong> <small>{{$post->area->name}}</small> <small>{{$post->getCommentsCount()}} comentários</small> 
                    </div>
                    <div class="col-lg-6">
                        <div class="pull-right">
                            por <a href="{{$post->author->getUrl()}}">{{$post->author->user_name}}</a> {{parseDate($post->created_at)}}
                            <span class="text-primary">4 <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></span>
                            <span class="text-success">7 <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></span>
                            <span class="text-danger">19 <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

    <hr>

</div>

@endsection