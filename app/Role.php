<?php

namespace App;

use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['role'];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function allRoles(){
        return Role::all();
    }
}
