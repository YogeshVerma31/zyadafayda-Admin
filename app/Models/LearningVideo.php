<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'thumbnail',
        'title',
        'sub_title',
        'link',
        'isYoutube',
    ];
}
