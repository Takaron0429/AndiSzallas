<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Velemeny extends Model
{
    protected $table = 'velemenyek'; // Tábla neve

    protected $fillable = [
        'nev', // Új mező: név
        'email', // Új mező: email
        'ertekeles',
        'komment',
    ];
}