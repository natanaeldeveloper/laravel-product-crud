<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'nome', 'id_categoria', 'descricao'
    ];

    public function categoria()
    {
        return $this->belongsTo(Category::class, 'id_categoria', 'id');
    }
}
