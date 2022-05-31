<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'unit', 'quantity', 'price','stock_code','status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function item_unit()
    {
        return [
            "Nos.",
            "Km",
            "Set.",
            "Kg.",
            "Km.",
            "set",
            "Ltr.",
            "kg",
            "Mtr.",
            "mtr",
            "Pair",
            "Nos",
            "Lot.",
            "Job.",
        ];
    }
}
