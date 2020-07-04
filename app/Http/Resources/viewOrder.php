<?php

namespace App\Http\Resources;

use App\library\library_my;
use Illuminate\Http\Resources\Json\JsonResource;

class viewOrder extends JsonResource
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
            'nameproducts'=>$this->nameproducts,
            'image'=>$this->image,
            'TotalProducts'=>library_my::formatMoney($this->TotalProducts),
            'quantity'=>$this->quantity,
            'price'=>library_my::formatMoney($this->price),
        ];
    }
}
