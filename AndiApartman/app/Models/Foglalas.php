<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foglalas extends Model
{
    use HasFactory;

    protected $primaryKey = 'foglalas_id';

    protected $fillable = [
        'erkezes',
        'tavozas',
        'felnott',
        'gyerek',
        'csomag_id',
        'akcio_id',
        'osszeg',
    ];

    
    protected $dates = [
        'erkezes',
        'tavozas',
    ];
    protected $table = 'foglalasok'; 

  

  

    public function vendeg()
    {
        return $this->belongsTo(Vendeg::class, 'vendeg_id', 'vendeg_id');
    }
}
