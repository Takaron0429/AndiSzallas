<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Velemeny extends Model
{
    public function vendeg(): BelongsTo
    {
        return $this->belongsTo(Vendeg::class, 'vendeg_id');
    }
}
