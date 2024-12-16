<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Property extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name', 'category', 'image', 'description', 'address', 'status','dimensions','nombre_chambres','dimensions_chambres','images_chambres','nombre_toilets','nombre_balcons','nombre_spacesVerts'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected $casts = [
        'dimensions_chambres' => 'array',
        'images_chambres' => 'array',
    ];
}
