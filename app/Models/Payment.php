<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'name_payment',
        'status',
    ];

    // Relación uno a muchos con SaleHeader
    public function saleHeaders()
    {
        return $this->hasMany(Sale_Header::class, 'payment_id');
    }
}
