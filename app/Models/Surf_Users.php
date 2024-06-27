<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surf_Users extends Model
{
    use HasFactory;
    protected $table = 'surf_users';
    protected $fillable = ['Username', 'Password', 'Role'];
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
    public function ratings()
    {
        return $this->hasMany(Ratings::class);
    }
}
