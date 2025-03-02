<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendeg extends Model
{
    protected $table = 'vendeg';
    public function vendeg()
    {
        return $this->belongsTo(Vendeg::class, 'vendeg_id');
    }
    
    public function foglalasok(): HasMany
    {
        return $this->hasMany(Foglalas::class, 'vendeg_id');
    }

    public function velemenyek(): HasMany
    {
        return $this->hasMany(Velemeny::class, 'vendeg_id');
    }
}
