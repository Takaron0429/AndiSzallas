<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fizetes extends Model
{
    public function foglalas(): BelongsTo
    {
        return $this->belongsTo(Foglalas::class, 'foglalas_id', 'foglalas_id');
    }
}
