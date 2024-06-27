<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Surf_Users extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'surf_users';
    protected $fillable = ['Username', 'Password', 'Role'];

    // // Hash the password when setting it
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['Password'] = Hash::make($value);
    // }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function ratings()
    {
        return $this->hasMany(Ratings::class);
    }
}