<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $fillable = ['Map','Star_Value'];
    public function surf_users()
    {
        return $this->belongsTo(Surf_Users::class);
    }
    public function surf_maps()
    {
        return $this->belongsTo(Surf_Maps::class);
    }
}
