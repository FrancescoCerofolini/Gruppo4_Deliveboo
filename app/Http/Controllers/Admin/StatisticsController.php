<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Order;

class StatisticsController extends Controller
{
    public function index() {

        $orders = DB::table('orders')
            ->selectRaw('COUNT(DISTINCT(orders.id)) AS orders,MONTH(orders.created_at) AS month')
            ->join('order_dish','order_dish.order_id','=','orders.id')
            ->join('dishes','dishes.id','=','order_dish.dish_id')
            ->where('dishes.user_id',Auth::id())
            ->whereYear('orders.created_at','=',2021)
            ->groupBy('month')
            ->get();
        $orders = json_decode($orders, true);

        $orders_pretty = array_fill(0,12,0);

        for ($i = 0; $i < count($orders); $i++) {
            $position = $orders[$i]['month'] - 1;
            $orders_pretty[$position] = $orders[$i]['orders'];
        }
        //@dd($orders_pretty);

        //Session["LatLon"] = JsonConvert.SerializeObject($orders_pretty);

        $data = [
            'orders_pretty' => $orders_pretty,
        ];

        return view('admin.statistics.index',$data);
    }
}
