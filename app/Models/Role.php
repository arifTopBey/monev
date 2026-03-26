<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    protected $table = 'roles';

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

    public function user(){
         return $this->hasMany(User::class, 'role_id', 'id');
    }
}
