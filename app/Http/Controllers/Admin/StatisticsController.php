<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Order;

class StatisticsController extends Controller
{
    public function index() {
        /* $orders_by_year = [];
        $counter_array = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        for ($counter = 0; $counter < count($counter_array); $counter++) {
            $orders_by_year[$counter] = DB::table('orders')->select('created_at')->whereYear('created_at','=',2021)->whereMonth('created_at','=',$counter_array[$counter])->get();
        } */

        $orders = DB::table('orders')
            ->selectRaw('COUNT(DISTINCT(orders.id)) AS orders,MONTH(orders.created_at) AS month')
            ->join('order_dish','order_dish.order_id','=','orders.id')
            ->join('dishes','dishes.id','=','order_dish.dish_id')
            ->where('dishes.user_id',1)
            ->whereYear('orders.created_at','=',2021)
            ->groupBy('month')
            ->get();
            
            /* ->count('orders.id'); */
            
            /* ->whereYear('created_at','=',2021)->groupBy(DB::raw('MONTH(created_at)'))->get(); */
        
        @dd($orders);
        return view('admin.statistics.index');
    }
}
