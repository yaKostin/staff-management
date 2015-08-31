@extends('layouts.default')
@section('content')
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Регистрация</h3>
        </div>
        <div class="panel-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="register">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label>Имя</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Фамилия</label>
                    <input type="text" name="surname" value="{{ old('surname') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Отчество</label>
                    <input type="text" name="patronymic" value="{{ old('patronymic') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>Пароль еще раз</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-success">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop