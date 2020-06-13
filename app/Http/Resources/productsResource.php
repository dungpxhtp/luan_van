<?php

namespace App\Http\Resources;

use App\Models\categoryproducts;
use App\Models\imageproduct;
use App\Models\productdorderscolor;
use App\Models\productglasses;
use App\Models\productmodel;
use App\Models\productssize;
use App\Models\productwaterproorf;
use Illuminate\Http\Resources\Json\JsonResource;

class productsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   $findModel=productmodel::findOrfail($this->id_productmodel);
        $findSize=productssize::findOrfail($this->id_productssize);
        $findWaterProorf=productwaterproorf::findOrfail($this->id_productwaterproorf);
        $findGlasses=productglasses::findOrfail($this->id_productglasses);
        $findCate=categoryproducts::findOrfail($this->id_categoryproducts);
        $findColor=productdorderscolor::findOrfail($this->id_productboder);
        $findImage=imageproduct::where([['id','=',$this->id],['status','=','1']])->select('title','caption','attribute','url')->get()->toArray();

        return [
            'id'=>$this->id,
            'nameModel'=>$findModel->name,
            'sizeProduct'=>$findSize->name,
            'waterProorf'=>$findWaterProorf->name,
            'glasses'=>$findGlasses->name,
            'categoryProducts'=>$findCate->name,
            'borderColor'=>$findColor->name,
            'name'=>$this->name,
            'code'=>$this->code,
            'slug'=>$this->slug,
            'imageUrl'=>$this->image,
            'detail'=>$this->detail,
            'metaKey'=>$this->metaKey,
            'metaDesc'=>$this->metadesc,
            'created_at'=>date("d/m/y",strtotime($this->created_at)),
            'previewImages'=>[
                $findImage
            ],
            'status'=>'200',

        ];
    }
}
