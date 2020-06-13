<?php

namespace App\Http\Resources;

use App\Models\brandproducts;

use App\Models\gendercategoryproducts;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class categoryproductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $findNameGioiTinh=gendercategoryproducts::where('id','=',$this->id_gendercategoryproducts)->first();
        $findCateProduct=brandproducts::where('id','=',$this->id_categoryproducts)->first();
        return [
            'data_categoryproducts'=>[
                'id'=>$this->id,
                 'name'=>$this->name,
                 'code'=>$this->code,
                 'slug'=>$this->slug,
                 'metakey'=>$this->metakey,
                 'metadesc'=>$this->metakey,
                 'created_at'=>date("d/m/y",strtotime($this->created_at)),
                 'gendercategoryproducts'=>[
                    'id_gendercategoryproducts'=>$this->id_gendercategoryproducts,
                    'name_gendercategoryproducts'=>$findNameGioiTinh->name,
                ],
                'brandproducts'=>[
                    'id_categoryproducts'=>$this->id_categoryproducts,
                    'name_categoryproducts'=>$findCateProduct->name,
                ],
            ],
            'status'=>200
        ];
    }
}
