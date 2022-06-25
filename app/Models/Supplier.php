<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name_of_supplier_firm', 'ajked_registration_no', 'type', 'category', 'description', 'status'];

    public function supplier_items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SupplierItem::class);
    }

    public static function supplier_list()
    {
        return [
            'M-1',
            'M-2',
            'M-3',
            'M-4',
            'M-5',
            'M-6',
            'M-7',
            'M-8',
            'M-9',
            'M-10',
            'M-11',
            'M-12',
            'M-13',
            'M-14',
            'M-15',
            'M-16',
            'M-17',
            'M-18',
            'M-19',
            'M-20',
            'M-21',
            'Other/Suppliers',
        ];
    }
}
