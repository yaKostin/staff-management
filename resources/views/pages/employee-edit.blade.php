@extends('layouts.default')

		@section('content')

            <img src="{{ URL::to('uploads/' . $user->id . '.jpg') }}" alt="Фотография" class="img-rounded">
			<form method="POST" files="true" enctype="multipart/form-data" action="{{ URL::to('employees/' . $user->id . '/edit') }} ">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label>Имя</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Фамилия</label>
                    <input type="text" name="surname" value="{{ $user->surname }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Отчество</label>
                    <input type="text" name="patronymic" value="{{ $user->patronymic }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Фотография</label>
                    <input type="file" name="image" accept="image/jpeg, image/png, image/gif" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="form-control btn btn-success">Изменить</button>
                </div>
            </form>

		@stop