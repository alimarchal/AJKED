<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    public $fillable = [
        'purchase_order_number',
        'purchase_order_date',
        'name_of_firm_supplier',
        'reference_number',
        'designation',
        'attachment',
        'status',
        'balance',
    ];


    public function purchase_order_items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }
}
