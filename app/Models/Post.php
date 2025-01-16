<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'content', 'is_published', 'publish_at', 'image'];

    protected $casts = [
        'publish_at' => 'datetime',
    ];

    protected $hidden = ['deleted_at']; // Скрыть deleted_at при преобразовании в JSON
}
