<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    //
    protected $table='post';
    public function nameAdminCreated()
    {
        return $this->belongsTo('App\Models\admin', 'created_by', 'id');
    }
    public function nameAdminUpdate()
    {
        return $this->belongsTo('App\Models\admin', 'updated_by', 'id');
    }
}
