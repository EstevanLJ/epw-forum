@extends('layouts.epw_bulma') 

@section('content')

    @if(isset($area))
        
        <h1 class="title is-1 has-text-centered">{{$area->name}} - Últimas Postagens</h1>

    @else

        <h1 class="title is-1 has-text-centered">Últimas Postagens</h1>

    @endif

    <hr>
    
    <div class="columns">
        <div class="column is-half is-offset-one-quarter">
            <form action="/search" method="POST">
                {{csrf_field()}}

                @if(isset($area))        
                    <input type="hidden" name="area" value="{{$area->id}}">
                @endif

                <div class="field has-addons">
                    <div class="control is-expanded">
                        <input class="input" type="text" name="search" placeholder="Título ou conteúdo">
                    </div>
                    <div class="control">
                        <button type="submit" class="button is-link">
                            Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    
    
    
    <hr>

    @foreach($posts as $post)

        <div class="box">

            <nav class="level">
                <div class="level-left">
                    <div class="level-item">
                        <p class="subtitle is-5">

                            @if($post->isArchived())                    
                                
                                <span class="tag is-warning">Arquivado</span>

                            @endif

                            <strong><a href="{{$post->getUrl()}}">{{$post->title}}</a></strong> 
                            
                            @unless(isset($area))                    
                                
                                <small>{{$post->area->name}}</small>

                            @endif
                        
                            <small>{{$post->getCommentsCount()}} comentário{{$post->getCommentsCount() > 1 ? 's' : ''}}</small>
                            
                        </p>
                    </div>
                </div>
                <div class="level-right">
                    <p class="level-item">
                        por&nbsp;<a href="{{$post->author->getUrl()}}">{{$post->author->user_name}}</a>&nbsp;{{getDataDiff($post->created_at)}} 
                        {{--  &nbsp;7 <span class="icon"><i class="fa fa-thumbs-o-up"></i></span>                            
                        &nbsp;3<span class="icon"><i class="fa fa-thumbs-o-down"></i></span>  --}}
                    </p>
                </div>
            </nav>

        </div>

    @endforeach

</div>

@endsection