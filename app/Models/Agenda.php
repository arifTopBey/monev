<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
     protected $table = 'ci_pembinaan_id';

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

    // karena tidak ada kolom created_at dan updated_at
    public $timestamps = false;

    public function pembinaan(){
        return $this->hasMany(Pembinaan::class, 'agendaPembinaanId', 'id');
    }
}
