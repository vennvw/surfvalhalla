<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surf_Maps extends Model
{
    use HasFactory;
    protected $table = 'surf_maps';
    protected $fillable = ['Name', 'Image', 'Status', 'Tier'];
    public function comments()
    {
        return $this->hasMany(Comments::class, 'surf_maps_id', 'id');
    }
    public function ratings()
    {
        return $this->hasMany(Ratings::class, 'surf_maps_id', 'id');
    }
}
