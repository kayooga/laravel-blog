<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    //テーブル名//テーブルとこのclassをひもづける
    protected $table = 'blogs';

    //可変項目//配列
    protected $fillable = 
    [
        'title',
        'content'
    ];
}
