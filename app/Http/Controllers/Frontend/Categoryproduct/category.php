<?php

namespace App\Http\Controllers\Frontend\Categoryproduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class category extends Controller
{
    //
    public function index()
    {
        return response()->json('data');
    }
}
