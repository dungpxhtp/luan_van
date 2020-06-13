<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\commentproductsResource;
use App\Models\commentproducts;

use Exception;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;
class commentUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user;

    public function index($id)
    {
        try {
            //code...
            $getAll=commentproducts::where([['commentproducts.id_product','=',$id],['products.status','=','1'],['parentid','=','0']])->join('products','commentproducts.id_product','products.id')->select('commentproducts.*')->get();
            if($getAll->isEmpty())
            {
                return response()->json([
                    'data'=>'Not Data'
                ]);
            }
            return response()->json(
                commentproductsResource::collection($getAll)
            );

        } catch (Exception $e) {
            return response()->json([
                'error'=>[
                    'messagess'=>$e->messages()
                ],
                'status'=>500,
            ],200);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request,$idProduct,$parentid)
    {


        try {
            $findUser= JWTAuth::parseToken()->authenticate();

            $v =Validator::make($request->all(), [
                'commentText'=>'required',

            ], [
                'commentText.required'=>'Nhập nội dung bình luận'
            ]);
            if ($v->fails())
            {
                return response()->json([
                    'error'=>[
                        'messagess'=>$v->messages()
                    ],
                    'status'=>200,
                ],200);
            }
            $newRow= new commentproducts;
            $newRow->id_product=$idProduct;
            $newRow->id_user=$findUser->id;
            $newRow->commentText=$request->commentText;
            $newRow->parentid=$parentid;
            $newRow->likesCount=0;
            $newRow->dislikeCount=0;
            $newRow->save();
            return response()->json([
                'success'   =>  true,
                'data'=>$newRow,
                'status'=>200
            ], 200);


        } catch (\xception $e) {
            return response()->json([
                'error'=>[
                    'messagess'=>$e->messages()
                ],
                'status'=>500,
            ],200);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
