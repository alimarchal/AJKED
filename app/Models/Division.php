<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_name',
        'receiving_person_name',
        'designation',
        'status',
    ];

    public static function division_list(): array
    {
        return [
            'Executive Engineer (E) Operation Division Garhi Dupatta',
            'Executive Engineer (E) Operation Division Athmuqam',
            'Executive Engineer (E) Operation Division Jhelum Valley',
            'Executive Engineer (E) Operation Division Bagh',
            'Executive Engineer (E) Operation Division Rawalakot',
            'Executive Engineer (E) Operation Division Hajira',
            'Executive Engineer (E) Operation Division Sudhnoti',
            'Executive Engineer (E) Operation Division Abbaspur',
            'Executive Engineer (E) Operation Division Kahutta',
            'Executive Engineer (E) Store Division Mirpur',
            'Executive Engineer (E) Grid/Construction ',
            'Power Development organization Muzaffarabad',
        ];
    }
}
