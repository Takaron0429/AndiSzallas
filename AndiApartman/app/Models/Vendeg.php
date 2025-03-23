<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendeg extends Model
{
    protected $table = 'vendeg';
    protected $primaryKey = 'vendeg_id';
    public function vendeg()
    {
        return $this->belongsTo(Vendeg::class, 'vendeg_id','vendeg_id');
    }
    
    public function foglalasok():HasMany
    {
        return $this->hasManyy(Foglalas::class, 'vendeg_id','vendeg_id');
    }
    use HasFactory;
 

  

    protected $fillable = [
        'nev', 'email', 'telefon', 'iranyitoszam', 'lakcim'
    ];
    
    public function velemenyek()
    {
        return $this->hasMany(Velemeny::class, 'vendeg_id', 'vendeg_id');
    }
    
    public function foglalasForeign()
    {
        return $this->hasMany(Foglalas::class, 'vendeg_id', 'vendeg_id');
    }
    
}
