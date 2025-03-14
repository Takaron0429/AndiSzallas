<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Velemeny extends Model
{
    protected $table = 'velemenyek'; // Ellenőrizd, hogy a tábla neve helyes-e
    protected $fillable = [
        'nev',
        'email',
        'ertekeles',
        'komment',
    ];
}