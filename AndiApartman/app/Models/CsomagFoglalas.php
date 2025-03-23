<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CsomagFoglalas extends Model
{
    protected $table = 'csomag_foglalas';

    protected $primaryKey = 'foglalas_id';
    protected $fillable = [
      'foglalas_id', 'csomag_id'
    ];
}
