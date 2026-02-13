<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimMonitoring extends Model
{

      protected $table = 'm_tim_monitoring';

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
