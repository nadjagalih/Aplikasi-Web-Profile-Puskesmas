<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    
    protected $fillable = ['judul', 'deskripsi', 'cover_image', 'user_id'];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function images()
    {
        return $this->hasMany(AlbumImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
