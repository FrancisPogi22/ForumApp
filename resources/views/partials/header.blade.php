<section id="header">
    <div class="wrapper">
        <div class="header-con">
            <ul class="navbar">
                @guest
                    <li>
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}">Register</a>
                    </li>
                @endguest
                @auth
                    <li>
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}">Logout</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</section>
