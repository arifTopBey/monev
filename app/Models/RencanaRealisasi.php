<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RencanaRealisasi extends Model
{

    protected $table = 'm_rencana_realisasi_investasi';

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
}
