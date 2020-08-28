<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class commentproducts extends Model
{
    //
    protected $table='commentproducts';
    public $timestamps = FALSE;
    public function getNameComment()
    {
        return $this->belongsTo('App\Models\users','id_user','id');
    }
    public function getNameProducts()
    {
        return $this->belongsTo('App\Models\products','id_product','id');
    }
    public function getNameAdmin()
    {
        return $this->belongsTo('App\Models\admin','id_admin','id');
    }

}
