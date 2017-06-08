@extends('layouts.epw')


@section('content')

    <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <h1>Áreas do fórum</h1>
                    <hr>
                </div>
            </div>
        </div>

        {{-- Padrão --}}
        {{-- <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-8">
                        <a href="#">
                            <h3>Geradores <small>51 postagens, 413 comentários</small></h3>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <div class="pull-right" style="padding-top: 20px">
                            ultima postagens por <a href="#">estevan.junges</a> à 3 horas
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        @foreach($areas as $area)

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-7">                            
                            <h3>
                                <a href="{{route('area', $area->id)}}">{{$area->name}}</a> 
                                <small>{{$area->getPostsCount()}} postagens, alguns comentários</small>
                            </h3>                            
                        </div>
                        <div class="col-lg-5">
                            <div class="pull-right" style="padding-top: 20px">
                                ultima postagens por <a href="{{route('user', $area->lastPost()->author->id)}}">{{$area->lastPost()->author->user_name}}</a> {{parseDate($area->lastPost()->created_at)}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

        <hr>

@endsection