<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelyiProgramajanlo extends Model
{
    protected $table ='helyi_programajanlok';
    protected $fillable = [
        'cim', 
        'helyszin',
        'kezdet',
        'vege',
        'leiras',
        'link',
        'kep',
    ];
    protected $primaryKey = 'program_id';
}
