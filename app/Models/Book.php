<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $visible=['id', 'title', 'author', 'publish_year', 'page_count'];
    protected $fillable=[ 'title', 'author', 'publish_year', 'page_count'];
}
