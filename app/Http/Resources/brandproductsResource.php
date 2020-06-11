<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class brandproductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data_brandproducts'=>[
                'id'=>$this->id,
                'name'=>$this->name,
                'slug'=>$this->slug,
                'image'=>$this->image,
                'detail'=>$this->detail,
                'metakey'=>$this->metakey,
                'metadesc'=>$this->metadesc,
                'created_at'=>date("d/m/y",strtotime($this->created_at)),
            ],
            'status'=>200
        ];
    }
}
