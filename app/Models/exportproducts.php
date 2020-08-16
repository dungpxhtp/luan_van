<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exportproducts extends Model
{
    //
    protected $table="exportproducts";
    public $timestamps = false;
    public function nameAdminExports()
    {
        return $this->belongsTo('App\Models\admin', 'updated_by', 'id');
    }
    public function products()
    {
        return $this->belongsTo('App\Models\products', 'id_products', 'id');
    }
}
