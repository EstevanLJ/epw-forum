<nav class="navbar is-dark">
    <div class="navbar-brand">
        <a class="navbar-item" href="{{ route('home') }}">
            <strong>Electrical Power Forum</strong>
        </a>

    </div>

    <div id="navMenuTransparentExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item " href="{{ route('area.index') }}">
                Áreas
            </a>
            <a class="navbar-item " href="{{ route('post.index') }}">
                Posts
            </a>
        </div>

        <div class="navbar-end">
        
            @if(Auth::user()->isAdmin())
                <a class="navbar-item" href="{{ route('admin-panel') }}">
                    Painel de Administração
                </a>
            @endif 
            
            @can('create', \App\Post::class)
                <a href="{{ route('post.create') }}" class="navbar-item is-tab is-hidden-mobile">
                    <span class="tag is-link is-medium">Novo Post</span>
                </a>
            @endcan

            <a class="navbar-item is-tab" href="{{Auth::user()->getUrl()}}">{{Auth::user()->getFullName()}}</a>

            <a class="navbar-item is-tab" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>

        </div>
    </div>
</nav>