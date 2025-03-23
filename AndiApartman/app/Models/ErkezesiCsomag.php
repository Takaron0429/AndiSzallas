<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ErkezesiCsomag extends Model
{
    protected $table ='erkezesi_csomagok';
    protected $primaryKey = 'csomag_id';
    protected $fillable = [
        'nev',
        'ar',       
        'leiras',    
        'elerheto', 
    ];
   public function foglalasok()
    {
        return $this->belongsToMany(Foglalas::class, 'csomag_foglalas', 'foglalas_id', 'csomag_id');
    }
}
