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
            <div class="">
                <p>{{$post->text}}</p>
            </div>
        </div>
    </div>

    {{--
    <div class="row">
        <div class="col-sm-12">
            <h3>Comentários:</h3>
        </div>
    </div> --}}

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
            <div class="">
                <p>{{$comment->comment}}</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-offset-3 col-sm-9">


            <button class="btn btn-white text-success"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></button>            
            {{-- <button class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></button>            --}}

            <button class="btn btn-white text-danger"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></button>            
            {{-- <button class="btn btn-danger"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></button>            --}}

            <span class="label label-success">0</span>
            <span class="label label-danger">0</span>

        </div>
    </div>

    <hr> 
    
    @endforeach 

    {{-- Novo comentário --}}
    <div class="row">
        <div class="col-sm-offset-3 col-sm-9">
            <h3 class="text-center">Novo comentário:</h3>             
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">    
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="novo-comentario-text" class="col-sm-3 control-label">Comentário</label>
                    <div class="col-sm-9">
                        <textarea id="novo-comentario-text" class="form-control" rows="5" placeholder="..."></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button id="novo-comentario-cancel" type="submit" class="btn btn-default pull-left">Cancelar</button>
                        <button id="novo-comentario-submit" type="submit" class="btn btn-primary pull-right">Enviar</button>
                    </div>
                </div>
            </form>
        </div>    
    </div>


    <div id="novo-comentario-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 id="novo-comentario-modal-title" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <p id="novo-comentario-modal-message"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <hr>


    @push('scripts')

    <script>
        $(document).ready(function () {
            
            document.getElementById('novo-comentario-submit').addEventListener('click', function(e) {
                e.preventDefault();

                let text = document.getElementById('novo-comentario-text').value;
                
                if(text != '') {
                    axios({
                        method: 'POST',
                        url: '/api/comment',
                        data: {
                            post_id: post_id,
                            comment: btoa(text)
                        }
                    }).then((res) => {

                        console.log(res);

                        $('#novo-comentario-modal-title').html('Sucesso!');
                        $('#novo-comentario-modal-message').html('Comentário salvo com sucesso!');
                    }).catch((err) => {
                        $('#novo-comentario-modal-title').html('Erro!');
                        $('#novo-comentario-modal-message').html('Algo deu errado!');   
                    })

                } else {
                    $('#novo-comentario-modal-title').html('Erro!');
                    $('#novo-comentario-modal-message').html('Por favor, digite alguma coisa!');
                }

                $('#novo-comentario-modal').modal('show');
            });

            document.getElementById('novo-comentario-cancel').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('novo-comentario-text').value = '';
            });


        });
    
    </script>

    @endpush

</div>

@endsection