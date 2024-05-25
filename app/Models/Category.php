<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_category';

    protected $fillable = [
        'category_name',
        'status',
    ];

    // Relación uno a muchos con Product
    public function products()
    {
        return $this->hasMany(Product::class, 'id_category');
    }
}
