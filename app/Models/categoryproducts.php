<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categoryproducts extends Model
{
    //
        protected $table='categoryproducts';
        public function updateName()
        {
            return $this->belongsTo('App\Models\admin','updated_by','id');
        }
        public function getNameCreate()
        {
            return $this->belongsTo('App\Models\admin','created_by','id');
        }

}
