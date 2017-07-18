@extends('layouts.epw_bulma') 

@section('content')

    <div class="columns">
        <div class="column is-one-quarter">

            <figure class="image" style="height: 256px; width: 256px;">
                <img src="{{$user->getAvatarUrl()}}" alt="Image">
            </figure>

            <br>

            <h4 class="title is-4">{{$user->getFullName()}}</h4>
            <h5 class="subtitle is-5"><a href="#">{{'@' . $user->user_name}}</a></h5>

            <hr>
            
            <h5 class="title is-5">
                {{$user->posts->count() > 0 ? ($user->posts->count() > 1 ? $user->posts->count() . ' posts' : $user->posts->count() . ' pots') : 'Nenhum Post'}}
            </h5>

            <h5 class="title is-5">
                {{$user->comments->count() > 0 ? ($user->comments->count() > 1 ? $user->comments->count() . ' comentários' : $user->posts->count() . ' comentário') : 'Nenhum Comentário'}}
            </h5>
            

        </div>

        <div class="column">
            <div class="tabs">
                <ul>
                    <li class="is-active"><a>Últimos Posts</a></li>
                    {{--  <li><a>Comentários</a></li>  --}}
                </ul>
            </div>

            <div class="columns">
                <div class="column">

                    @if($user->posts->count() > 0)

                        @foreach($user->lastPosts() as $post)
                            <div class="box">
                                <nav class="level">
                                    <div class="level-left">
                                        <div class="level-item">
                                            <p class="subtitle is-5">
                                                <strong><a href="{{$post->getUrl()}}">{{$post->title}}</a></strong> 
                                                <small>{{$post->area->name}}</small>
                                                <small>{{$post->getCommentsCount()}} comentário{{$post->getCommentsCount() > 1 ? 's' : ''}}</small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="level-right">
                                        <p class="level-item">
                                            {{getDataDiff($post->created_at)}}
                                        </p>
                                    </div>
                                </nav>
                            </div>
                        @endforeach

                    @else

                        <h4 class="title is-4 has-text-centered">Nenhum post até o momento!</h4>

                    @endif


                </div>
            </div>



        </div>    
    </div>


    <hr>


@endsection