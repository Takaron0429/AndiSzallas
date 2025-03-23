<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foglalas extends Model
{
    use HasFactory;

    protected $primaryKey = 'foglalas_id';

    protected $fillable = [
        'erkezes',
        'tavozas',
        'felnott',
        'gyerek',
        'csomag_id',
        'akcio_id',
        'osszeg',
        'foglalas_allapot',  // Ha az állapotokat is frissíteni akarod
        'fizetes_allapot',
        'vendeg_id',
        'checkin',
        'checkout',
        'specialis_keresek'
    ];


    protected $dates = [
        'erkezes',
        'tavozas',
    ];
    protected $table = 'foglalasok';

    public function csomagok()
    {
        return $this->belongsToMany(ErkezesiCsomag::class, 'csomag_foglalas', 'foglalas_id', 'csomag_id');
    }

    public function akciok()
    {
        return $this->belongsToMany(Akcio::class, 'akcio_foglalas', 'foglalas_id', 'akcio_id');
    }



    public function vendeg()
    {
        return $this->belongsTo(Vendeg::class, 'vendeg_id', 'vendeg_id');
    }

    public function frissitOsszeg()
    {
        $total = 0;
        $days = $this->erkezes->diffInDays($this->tavozas);

        foreach ($this->csomagok as $csomag) {
            if ($csomag) {
                $total += ($this->felnott * $csomag->ar + $this->gyerek * ($csomag->ar * 0.5)) * $days;
            }
        }

        $this->osszeg = $total;
        $this->save();
    }

}
