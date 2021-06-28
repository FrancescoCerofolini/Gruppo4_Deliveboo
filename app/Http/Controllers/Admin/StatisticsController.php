<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Order;

class StatisticsController extends Controller
{
    public function index(Request $request) {
        //@dd($request);

        for ($i = 0; $i < 10; $i++) {
            ${'orders_by_month_' . (2012 + $i)} = DB::table('orders')
                ->selectRaw('COUNT(DISTINCT(orders.id)) AS orders,MONTH(orders.created_at) AS month')
                ->join('order_dish','order_dish.order_id','=','orders.id')
                ->join('dishes','dishes.id','=','order_dish.dish_id')
                ->where('dishes.user_id',Auth::id())
                ->whereYear('orders.created_at','=',2012 + $i)
                ->groupBy('month')
                ->get();
        };

        $orders_by_year = DB::table('orders')
            ->selectRaw('COUNT(DISTINCT(orders.id)) AS orders,YEAR(orders.created_at) AS year')
            ->join('order_dish','order_dish.order_id','=','orders.id')
            ->join('dishes','dishes.id','=','order_dish.dish_id')
            ->where('dishes.user_id',Auth::id())
            ->groupBy('year')
            ->get();
        //@dd($orders_by_year);

        for ($i = 0; $i < 10; $i++) {
            ${'orders_by_month_' . (2012 + $i)} = json_decode(${'orders_by_month_' . (2012 + $i)}, true);
        };
        $orders_by_year = json_decode($orders_by_year, true);


        for ($i = 0; $i < 10; $i++) {
            ${'orders_by_month_pretty_' . (2012 + $i)} = array_fill(0,12,0);
        };
        $orders_by_year_pretty = array_fill(0,10,0);


        for ($i = 0; $i < 10; $i++) {
            for ($t = 0; $t < count(${'orders_by_month_' . (2012 + $i)}); $t++) {
                $position = ${'orders_by_month_' . (2012 + $i)}[$t]['month'] - 1;
                ${'orders_by_month_pretty_' . (2012 + $i)}[$position] = ${'orders_by_month_' . (2012 + $i)}[$t]['orders'];
            }
        };

        //@dd($orders_by_year);
        for ($i = 0; $i < count($orders_by_year); $i++) {
            $position = $orders_by_year[$i]['year'] - 2012;
            $orders_by_year_pretty[$position] = $orders_by_year[$i]['orders'];
        }
        //@dd($orders_by_year_pretty);
        $id = Auth::id();
        $user = User::all()->where('id', $id);

        $orders_by_month_pretty = [];
        for ($i = 0; $i < 10; $i++) {
            $orders_by_month_pretty[] = ${'orders_by_month_pretty_' . (2012 + $i)};
        };

        //@dd($orders_by_month_pretty);
        $data = [
            'orders_by_month_pretty' => $orders_by_month_pretty,
            'orders_by_year_pretty' => $orders_by_year_pretty,
            'user' => $user
        ];

        return view('admin.statistics.index',$data);
    }
}
