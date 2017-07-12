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
                            <strong><a href="{{$area->getUrl()}}">{{$area->name}}</a></strong> 
                            
                            <small>{{$area->getPostsCount()}} postagens, {{$area->getCommentsCount()}} comentários</small>

                        </p>
                    </div>
                </div>

                @if($area->getPostsCount() > 0)

                    <div class="level-right">
                        <p class="level-item">
                            ultima postagens por&nbsp;<a href="{{$area->lastPost()->author->getUrl()}}">{{$area->lastPost()->author->user_name}}</a>&nbsp;{{getDataDiff($area->lastPost()->created_at)}} 
                        </p>
                    </div>

                @endif
                
            </nav>

        </div>

    @endforeach

</div>

@endsection