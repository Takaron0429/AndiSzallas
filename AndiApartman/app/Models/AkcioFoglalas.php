<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AkcioFoglalas extends Model
{
    protected $table = 'akcio_foglalas';

    
    protected $primaryKey = 'foglalas_id';
    protected $fillable = [
      'foglalas_id', 'akcio_id'
    ];
}
