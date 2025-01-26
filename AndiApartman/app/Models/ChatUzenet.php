<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatUzenet extends Model
{
    public function vendeg(): BelongsTo
    {
        return $this->belongsTo(Vendeg::class, 'vendeg_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
