<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Model
{
    
    protected $table = 'admin';
    public function chatUzenetek(): HasMany
    {
        return $this->hasMany(ChatUzenet::class, 'admin_id', 'admin_id') ;
    }
  
}
