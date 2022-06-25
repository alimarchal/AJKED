<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    public $fillable = [
        'purchase_order_id',
        'product_id',
        'quantity',
        'balance',
    ];

    use HasFactory;

}
