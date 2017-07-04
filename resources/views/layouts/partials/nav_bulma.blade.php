<nav class="nav has-shadow">
    <div class="container">
        <div class="nav-left">
            <a class="nav-item">
                <strong>Electrical Power Forum</strong>
            </a>
            <a class="nav-item is-tab is-hidden-mobile {{ Route::currentRouteName() == 'areas' ? 'is-active' : '' }}">Áreas</a>
            <a class="nav-item is-tab is-hidden-mobile {{ Route::currentRouteName() == 'posts' ? 'is-active' : '' }}">Posts</a>
            <a class="nav-item is-tab is-hidden-mobile {{ Route::currentRouteName() == 'users' ? 'is-active' : '' }}">Usuários</a>
        </div>
        <span class="nav-toggle">
        <span></span>
        <span></span>
        <span></span>
        </span>
        <div class="nav-right nav-menu">
            <a class="nav-item is-tab">{{Auth::user()->getFullName()}}</a>
            <a class="nav-item is-tab" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</nav>