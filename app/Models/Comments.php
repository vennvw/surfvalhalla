<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ['comment', 'surf_maps_id', 'surf_users_id'];
    public function surf_users()
    {
        return $this->belongsTo(Surf_Users::class, 'surf_users_id', 'id');
    }
    public function surf_maps()
    {
        return $this->belongsTo(Surf_Maps::class, 'surf_maps_id', 'id');
    }
}
