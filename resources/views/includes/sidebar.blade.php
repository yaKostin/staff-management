<nav id='sidebar-nav' style=''>
	<p> <h2>Сотрудники в виде</h2> </p>
    <ul class='nav nav-pills nav-stacked'>
        <li class="{{ (Request::is('employees/hierarchy') ? 'active' : '') }}">
        	<a href="{{ URL::to('employees/hierarchy') }}">Иерархия</a>
        </li>
        <li class="{{ (Request::is('employees/grid') ? 'active' : '') }}">
        	<a href="{{ URL::to('employees/grid') }}">Таблица</a>
        </li>
    </ul>
</nav>