<?php

namespace App\Models;

use Baum\Node;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Node implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'surname', 'salary', 'patronymic', 'position_id', 'email', 'password', 'hire_date'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];

    protected $guarded = ['id'];

    public function position()
    {
        return $this->belongsTo('App\Models\Position');
    }

    public static function getFullHierarchy()
    {
        return User::where('position_id', '<>', 'null')->get()->toHierarchy();
    }

    public static function getAllEmployeesQuery()
    {
        return User::where('position_id', '<>', 'null');
    }
}