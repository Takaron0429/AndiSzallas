<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Akcio extends Model
{
    protected $table ='akciok';
    public function foglalasok(): HasMany
    {
        return $this->hasMany(Foglalas::class, 'akcio_id');
    }
}
