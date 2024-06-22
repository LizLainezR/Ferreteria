<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transfer_payments extends Model
{
    use HasFactory;
    protected  $primaryKey="transfer_payment_id";
    protected $fillable = [
        'sale_header_id',
        'bank_name',
        'account_number',
        'transaction_reference',
    ];

    public function salesHeader()
    {
        return $this->belongsTo(Sale_Header::class, "sale_header_id");
    }
}
