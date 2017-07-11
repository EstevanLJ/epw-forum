@extends('layouts.epw_bulma') 

@section('content')

    <h1 class="title is-1 has-text-centered">Áreas do fórum</h1>

    <hr>

    @foreach($areas as $area)

        <div class="box">

            <nav class="level">
                <div class="level-left">
                    <div class="level-item">
                        <p class="subtitle is-5">
                            <strong><a href="{{route('area', $area->id)}}">{{$area->name}}</a></strong> 
                            
                            {{$area->getPostsCount()}} postagens, {{$area->getCommentsCount()}} comentários

                        </p>
                    </div>
                </div>
                <div class="level-right">
                    <p class="level-item">
                        ultima postagens por&nbsp;<a href="{{$area->lastPost()->author->getUrl()}}">{{$area->lastPost()->author->user_name}}</a>&nbsp;{{parseDate($area->lastPost()->created_at)}} 
                    </p>
                </div>
            </nav>

        </div>

    @endforeach

</div>

@endsection