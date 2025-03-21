<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Velemeny extends Model
{
    protected $table = 'velemenyek'; 
    protected $fillable = [
        'nev',
        'email',
        'ertekeles',
        'komment',
        'approved', // Ha szükséges
    ];

    protected $primaryKey = 'velemeny_id'; // Módosítás itt!
    public $timestamps = true;
}