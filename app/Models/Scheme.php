<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheme extends Model
{
    use HasFactory;

    public $fillable = [
        'approval_number',
        'date',
        'name_of_scheme',
        'type_of_scheme',
        'designation',
        'name',
        'approved_by',
    ];


    public function scheme_items()
    {
        return $this->hasMany(SchemeItem::class);
    }
}
