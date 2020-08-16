<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    //
    protected $table='orders';
    public $timestamps = FALSE;
    public function nameAdminUpdate()
    {
        return $this->belongsTo('App\Models\admin', 'updated_by', 'id');
    }
}
