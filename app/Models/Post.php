<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Указываем, какие поля можно массово заполнять
    protected $fillable = ['title', 'content', 'is_published', 'publish_at', 'image'];

    // Указываем типы данных для столбцов
    protected $casts = [
        'publish_at' => 'datetime',
    ];
}
