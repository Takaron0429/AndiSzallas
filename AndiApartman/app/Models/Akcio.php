<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Akcio extends Model
{
    protected $table = 'akciok';    
    protected $primaryKey = 'akcio_id';
    protected $fillable = [
        'cim',     
    ];
    public function foglalasok()
    {
        return $this->belongsToMany(Foglalas::class, 'akcio_foglalas', 'foglalas_id', 'akcio_id');
    }
    
}
