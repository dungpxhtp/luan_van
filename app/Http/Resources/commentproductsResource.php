<?php

namespace App\Http\Resources;

use App\Models\commentproducts;
use Illuminate\Http\Resources\Json\JsonResource;

class commentproductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   $findReplyComment=commentproducts::where('parentid','=',$this->id)->orderBy('created_at','desc')->get()->toArray();

      return   [
            'id'=>$this->id,
            'idAdmin'=>$this->id_admin,
            'idUser'=>$this->id_user,
            'idProduct'=>$this->id_product,
            'commentText'=>$this->commentText,
            'likesCount'=>$this->likesCount,
            'parentid'=>$this->parentid,
            'dislikeCount'=>$this->dislikeCount,
            'created_at'=>date("d/m/y",strtotime($this->created_at)),
            'previewReplyComment'=>[
                $findReplyComment,
            ],
            'status'=>'200',
        ];
    }
}
