<?php

namespace App\Models;

use App\Http\Controllers\VendegController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Foglalas extends Model
{
    protected $table = 'foglalasok';
    public function vendeg(): BelongsTo
    {
        return $this->belongsTo(Vendeg::class, 'vendeg_id');
    }

    public function csomag(): BelongsTo
    {
        return $this->belongsTo(ErkezesiCsomag::class, 'csomag_id');
    }

    public function akcio(): BelongsTo
    {
        return $this->belongsTo(Akcio::class, 'akcio_id');
    }

    public function fizetesek(): HasMany
    {
        return $this->hasMany(Fizetes::class, 'foglalas_id');
    }
}
