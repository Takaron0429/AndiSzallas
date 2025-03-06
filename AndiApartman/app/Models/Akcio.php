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
    public function foglalasok(): HasMany
    {
        return $this->hasMany(Foglalas::class, 'akcio_id', 'akcio_id'); 
    }
}
