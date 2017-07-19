<nav class="nav has-shadow">
    <div class="container">
        <div class="nav-left">
            <a class="nav-item">
                <strong style="color: #fff">Electrical Power Forum</strong>
            </a>
            <a href="{{ route('area.index') }}" class="nav-item is-tab is-hidden-mobile {{ Route::currentRouteName() == 'area.index' ? 'is-active' : '' }}">Áreas</a>
            <a href="{{ route('post.index') }}" class="nav-item is-tab is-hidden-mobile {{ Route::currentRouteName() == 'post.index' ? 'is-active' : '' }}">Posts</a>
            {{--  <a href="{{ route('users') }}" class="nav-item is-tab is-hidden-mobile {{ Route::currentRouteName() == 'users' ? 'is-active' : '' }}">Usuários</a>  --}}
        </div>
     

        <div class="nav-right nav-menu">

            @if(Auth::user()->isAdmin())
                <a class="nav-item is-tab" href="{{ route('admin-panel') }}">Painel de Administração</a>
            @endif

            <a href="{{ route('post.create') }}" class="nav-item is-tab is-hidden-mobile">
                <span class="tag is-primary is-medium">Novo Post</span>
            </a>
            <a class="nav-item is-tab">{{Auth::user()->getFullName()}}</a>
            <a class="nav-item is-tab" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</nav>