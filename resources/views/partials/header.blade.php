<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
    <a class="navbar-brand" href="#">The Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsBlock"
            aria-controls="navbarsBlock" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsBlock">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">

                <a href="#" class="nav-link dropdown-toggle" id="dropdownBlock" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">User Account</a>
                <div class="dropdown-menu" aria-labelledby="dropdownBlock">
                    @guest
                        <a class="dropdown-item" href="{{ route('register') }}">Sign up</a>
                        <a class="dropdown-item" href="{{ route('login') }}">Sign in</a>
                        @else
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            @endguest
                </div>
            </li>
        </ul>
    </div>
</nav>