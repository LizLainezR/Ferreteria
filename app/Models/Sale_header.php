<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_header extends Model
{
    use HasFactory;
    protected $table = 'sale_headers';
    protected $primaryKey = 'header_id';

    protected $fillable = [
        'issue_date',
        'document_type',
        'invoice_number',
        'person',
        'reference',
        'seller_id',
        'due_date',
        'total_sale',
        'discount',
        'Iva',
        'id_unique',
        'payment_id'
    ];
   
    const ESTABLISHMENT_NUMBER = '001';
    const INVOICE_BOOK_NUMBER = '001';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->invoice_number = Sale_header::generateInvoiceNumber();
        });
    }

    public static function generateInvoiceNumber()
    {
        $lastInvoice = self::orderBy('created_at', 'desc')->first();
        if (!$lastInvoice) {
            return self::ESTABLISHMENT_NUMBER . '-' . self::INVOICE_BOOK_NUMBER . '-000000001';
        }

        $lastInvoiceNumber = substr($lastInvoice->invoice_number, 8); // Obtiene los últimos 9 dígitos
        $lastNumber = intval($lastInvoiceNumber);
        $newNumber = str_pad($lastNumber + 1, 9, '0', STR_PAD_LEFT);

        return self::ESTABLISHMENT_NUMBER . '-' . self::INVOICE_BOOK_NUMBER . '-' . $newNumber;
    }


    public function details()
    {
        return $this->hasMany(Sale_details::class, 'header_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');}
        public function customer()
    {
        return $this->belongsTo(Customers::class, 'id_unique');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function cash_header()
    {
        return $this->belongsTo(cash_payments::class, 'cash_payment_id');
    }
    public function transfer_payments()
    {
        return $this->belongsTo(transfer_payments::class, 'transfer_payment_id');
    }
}
