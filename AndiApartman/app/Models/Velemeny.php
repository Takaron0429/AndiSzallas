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
    ];

    protected $primaryKey = 'velemeny_id'; // Módosítás itt!
    public $timestamps = true;
    public function vendeg()
    {
        return $this->belongsTo(Vendeg::class, 'vendeg_id', 'vendeg_id');
    }
}