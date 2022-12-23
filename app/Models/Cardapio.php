<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{
    use HasFactory;

    protected $table = 'cardapio'; 

    protected $fillable = [
        'titulo',
        'content',
        'slug',
        'tags',
        'views',
        'categoria',
        'cat_pai',        
        'status'
    ];
}
