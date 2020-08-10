<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class topic extends Model
{
    //
    protected $table='topic';
    public $timestamps = FALSE;

    public function nameAdminUpdate()
    {
        return $this->belongsTo('App\Models\admin', 'updated_by', 'id');
    }
}
