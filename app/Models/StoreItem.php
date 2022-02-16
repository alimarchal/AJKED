<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'name',
        'unit',
    ];

    public static function store_item_categories()
    {
        return [
            'M-6',
            'M-3 (i)',
            'M-3 (i) AB',
            'M-11',
            'M-4',
            'M-13',
            'M-14',
            'M-18',
            'M-3 (ii)',
            'M-1',
            'M-8',
            'Miscellaneous',
            'M-2',
            'M-10',
            'M-19',
            'M-5',
            'M-9',
        ];
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
