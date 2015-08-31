<nav class="navbar navbar-default">
    <div class="container">

        <div class="navbar-header">
            <a class="navbar-brand" href="https://github.com/yakostin/staff-management">Сотрудники</a>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ URL::to('employees/hierarchy') }}">
                        Дерево
                    </a>
                </li>
                @if (Auth::guest())
                    <li class="{{ (Request::is('auth/login') ? 'active' : '') }}">
                        <a href="{{ URL::to('auth/login') }}">
                            <i class="fa fa-sign-in"> </i>
                            Вход
                        </a>
                    </li>
                    <li class="{{ (Request::is('auth/register') ? 'active' : '') }}">
                        <a href="{{ URL::to('auth/register') }}">
                            Регистрация
                        </a>
                    </li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i> 
                            {{ Auth::user()->name }} 
                            <i class="fa fa-caret-down"> </i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ URL::to('auth/logout') }}"> 
                                    <i class="fa fa-sign-out"> </i>
                                    Выйти 
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>

    </div>
</nav>