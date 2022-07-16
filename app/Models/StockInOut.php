<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'purchase_order_id',
        'delivery_chalan_receiving_date',
        'delivery_chalan_number',
        'delivery_chalan_date',
        'inspection_certification_number',
        'inspection_certification_date',
        'receiving_person_name',
        'receiving_person_designation',
        'from_supplier_person',
        'from_supplier_designation',
        'attachment_path',
        'type',
        'quantity',
        'balance',
        'indent_no',
        'indent_date',
        'division_id',
        'scheme_name',
        'approved_by_name',
        'approved_by_designation',
        'received_by_name',
        'received_by_designation',
        'return',
        'chalan_type',
        'scheme_id',
        'general_date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
