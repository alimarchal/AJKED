<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeItem extends Model
{
    use HasFactory;

    public $fillable = [
        'scheme_id',
        'product_id',
        'quantity',
        'balance',
    ];
}
