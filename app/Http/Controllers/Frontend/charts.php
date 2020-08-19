<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\orders;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\users;

class charts extends Controller
{
    //
    public function chartsUser(Request $request)
    {
        /*$user= User::select(\DB::raw("COUNT(*) as count"))

        ->whereYear('created_at', date('Y'))

        ->groupBy(\DB::raw("Month(created_at)"))

        ->pluck('count');*/

        $users = users::select('created_at')->whereYear('created_at', date('Y'))->orderBy('created_at','asc')
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
           return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $month_user = [];
        $count_user = [];

        foreach ($users as $key => $value) {
            $month_user[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($month_user[$i])){
                $count_user[$i] = $month_user[$i];
            }else{
                $count_user[$i] = 0;
            }
        }
    return response()->json($users);
    }
    public function chartsYearUser(Request $request,$year)
    {
        /*$user= User::select(\DB::raw("COUNT(*) as count"))

        ->whereYear('created_at', date('Y'))

        ->groupBy(\DB::raw("Month(created_at)"))

        ->pluck('count');*/
        if($request->ajax())
        {

        $users = users::select('created_at')->whereYear('created_at', $year)->orderBy('created_at','asc')
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
           return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $month_user = [];
        $count_user = [];

        foreach ($users as $key => $value) {
            $month_user[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($month_user[$i])){
                $count_user[$i] = $month_user[$i];
            }else{
                $count_user[$i] = 0;
            }
        }
    return response()->json($users);
        }

    }
    public function chartsOrders(Request $request,$year)
    {
      if($request->ajax())
      {
        $users = orders::select('created_at')->whereYear('created_at', $year)->orderBy('created_at','asc')
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
           return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $month_user = [];
        $count_user = [];

        foreach ($users as $key => $value) {
            $month_user[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($month_user[$i])){
                $count_user[$i] = $month_user[$i];
            }else{
                $count_user[$i] = 0;
            }
        }
      return response()->json($users);
      }
    }
    public function danhthu(Request $request,$year)
    {
      if($request->ajax())
      {
        $users = orders::where('status','=',4)->whereYear('created_at', $year)->select(\DB::raw('MONTH(created_at) as thang'),\DB::raw('SUM(TotalOrder) as Total'))->orderByRaw('MONTH(created_at)','asc')
        ->groupBy(\DB::raw('MONTH(created_at)'))->get();

      return response()->json($users);
      }
    }
}
