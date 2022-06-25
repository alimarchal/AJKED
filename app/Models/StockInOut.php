<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInOut extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'division_id', 'supplier_id', 'type', 'return', 'issued_date',
        'return_date', 'quantity', 'price', 'description', 'attachment_path', 'po_no', 'po_date', 'receiving_po_date',
        'previous_quantity', 'indent_no', 'indent_date', 'balance', 'purchase_order_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
