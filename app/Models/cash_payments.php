<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cash_payments extends Model
{
    use HasFactory;
   
    protected  $primaryKey="cash_payment_id";
    protected $fillable = [
        'sale_header_id',
        'amount_received',
    ];

    public function salesHeader()
    {
        return $this->belongsTo(Sale_Header::class);
    }
}
