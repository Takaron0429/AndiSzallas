<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ErkezesiCsomag extends Model
{
    protected $table ='erkezesi_csomagok';
    public function foglalasok(): HasMany
    {
        return $this->hasMany(Foglalas::class, 'csomag_id');
    }
}
