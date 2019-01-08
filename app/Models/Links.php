<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    //
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    protected $table = 'links';
    protected $fillable = ['code','link','expired','deleted','user_id'];

}
