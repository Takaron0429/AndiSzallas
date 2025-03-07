<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foglalas extends Model
{
    use HasFactory;

    protected $table = 'foglalasok'; // Ez kell

    protected $primaryKey = 'foglalas_id';

    protected $fillable = [
        'vendeg_id', 'erkezes', 'tavozas', 'felnott', 'gyerek',
        'osszeg', 'foglalas_allapot', 'fizetes_allapot',
        'speciális_keresek', 'csomag_id', 'akcio_id'
    ];

    public function vendeg()
    {
        return $this->belongsTo(Vendeg::class, 'vendeg_id', 'vendeg_id');
    }
}
