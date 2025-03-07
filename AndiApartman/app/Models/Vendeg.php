<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendeg extends Model
{
    use HasFactory;

    protected $table = 'vendeg'; // Ez kell, mert nem "vendegs" a tábla neve

    protected $primaryKey = 'vendeg_id';

    protected $fillable = [
        'nev', 'email', 'telefon', 'iranyitoszam', 'lakcim'
    ];

    public function foglalasok()
    {
        return $this->hasMany(Foglalas::class, 'vendeg_id', 'vendeg_id');
    }
}
