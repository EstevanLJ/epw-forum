<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Electrical Power Forum</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ Route::currentRouteName() == 'areas' ? 'active' : '' }}"><a href="/areas">Areas</a></li>
                <li class="{{ Route::currentRouteName() == 'posts' ? 'active' : '' }}"><a href="/posts">Posts</a></li>
                <li class="{{ Route::currentRouteName() == 'users' ? 'active' : '' }}"><a href="#">Usuários</a></li>
            </ul>

            <form class="navbar-form navbar-left" id="navBarSearchForm">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Areas, postagens, usuários...">
                </div>
                <button type="submit" class="btn btn-default">Buscar</button>
            </form>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">\/ <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Você não tem nenhuma notificação!</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Estevan Junges <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Perfil</a></li>
                        <li><a href="#">Configurações</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Sair</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>