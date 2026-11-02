<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    protected $fillable = ['full_name', 'email', 'password_hash', 'phone', 'address', 'role'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }
}
