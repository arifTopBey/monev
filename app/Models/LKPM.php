<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LKPM extends Model
{
    protected $table = 'm_lkpm';

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

    public function monev(){
         return $this->belongsTo(Monev::class, 'id_bap', 'id_bap');
    }
}
