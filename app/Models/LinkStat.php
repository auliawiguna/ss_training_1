<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkStat extends Model
{
    //
    const CREATED_AT = 'time';

    protected $table = 'link_stats';
    protected $fillable = ['link_id', 'ip', 'browser', 'time'];

	public function links()
    {
        return $this->belongsTo('\App\Models\Link','link_id');
    }

}
