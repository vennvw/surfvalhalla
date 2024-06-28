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

    public function comments()
    {
        return $this->hasMany(Comments::class, 'surf_users_id');
    }

    public function ratings()
    {
        return $this->hasMany(Ratings::class);
    }
}