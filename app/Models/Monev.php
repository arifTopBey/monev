<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monev extends Model
{
     protected $table = 'ci_monev';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_bap';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    public $timestamps = false;


    protected $guarded = ['id'];

     public function scopeSearch($query, $search)
    {
        return $query->where('nama_perusahaan', 'like', "%{$search}%");
                    // ->orWhere('namaPeserta', 'like', "%{$search}%")
                    // ->orWhere('alamatPerusahaan', 'like', "%{$search}%");
    }

    public function izinDimiliki(){
        return $this->hasOne(IzinDimiliki::class, 'id_bap', 'id');
    }

    public function izinLKPM() {
        return $this->hasOne(LKPM::class, 'id_bap', 'id_bap');
    }

}
