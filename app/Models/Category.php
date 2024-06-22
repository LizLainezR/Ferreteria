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

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
      public function products()
    {
        return $this->hasMany(Product::class, 'id_category');
    }
}
