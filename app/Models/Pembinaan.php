<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembinaan extends Model
{

    protected $table = 'ci_pembinaan';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    protected $guarded = ['id'];
    public $timestamps = false;

    public function Agenda(){
        return $this->belongsTo(Agenda::class, 'agendaPembinaanId', 'id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('namaPerusahaan', 'like', "%{$search}%")
                    ->orWhere('namaPeserta', 'like', "%{$search}%")
                    ->orWhere('alamatPerusahaan', 'like', "%{$search}%");
    }

}
