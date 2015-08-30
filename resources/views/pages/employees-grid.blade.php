@extends('layouts.default')
@section('content')
    <div class="title"> 
        <h1>Таблица сотрудников</h1>
    </div>
    <div id="users_grid">
        <ul>
            {!! $usersGrid !!}
        </ul>
    </div>
@stop