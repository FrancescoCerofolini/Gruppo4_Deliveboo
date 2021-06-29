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

                ${'amount_by_month_' . (2012 + $i)} = DB::table('orders')
                    ->selectRaw('SUM(DISTINCT(orders.amount)) AS amount,MONTH(orders.created_at) AS month')
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
        $amount_by_year_query = DB::table('order_dish')
            ->select(DB::raw('orders.amount AS amount,YEAR(orders.created_at) AS year'))
            ->join('dishes', 'order_dish.dish_id', '=', 'dishes.id')
            ->join('orders', 'order_dish.order_id', '=', 'orders.id')
            ->where('dishes.user_id', Auth::id())
            ->groupBy('orders.id')
            ->get();

        $amount_by_year = [];
        for ($i = 0; $i < 10; $i++) {
            $amount_by_year[$i] = 0;
            foreach ($amount_by_year_query as $amount) {
                if ($amount->year == 2012 + $i) {
                    $amount_by_year[$i] += $amount->amount;
                }
            }
        }

        /* $amount_by_year = DB::table('orders')
            ->selectRaw('SUM(orders.amount) AS amount,YEAR(orders.created_at) AS year')
            ->join('order_dish','order_dish.order_id','=','orders.id')
            ->join('dishes','dishes.id','=','order_dish.dish_id')
            ->where('dishes.user_id',Auth::id())
            ->groupBy('year')
            ->get(); */

        for ($i = 0; $i < 10; $i++) {
            ${'orders_by_month_' . (2012 + $i)} = json_decode(${'orders_by_month_' . (2012 + $i)}, true);
            ${'amount_by_month_' . (2012 + $i)} = json_decode(${'amount_by_month_' . (2012 + $i)}, true);
        };
        $orders_by_year = json_decode($orders_by_year, true);

        for ($i = 0; $i < 10; $i++) {
            ${'orders_by_month_pretty_' . (2012 + $i)} = array_fill(0,12,0);
            ${'amount_by_month_pretty_' . (2012 + $i)} = array_fill(0,12,0);
        };
        $orders_by_year_pretty = array_fill(0,10,0);
        $amount_by_year_pretty = array_fill(0,10,0);

        for ($i = 0; $i < 10; $i++) {
            for ($t = 0; $t < count(${'orders_by_month_' . (2012 + $i)}); $t++) {
                $position = ${'orders_by_month_' . (2012 + $i)}[$t]['month'] - 1;
                ${'orders_by_month_pretty_' . (2012 + $i)}[$position] = ${'orders_by_month_' . (2012 + $i)}[$t]['orders'];
                ${'amount_by_month_pretty_' . (2012 + $i)}[$position] = ${'amount_by_month_' . (2012 + $i)}[$t]['amount'];
            }
        };

        for ($i = 0; $i < count($orders_by_year); $i++) {
            $position = $orders_by_year[$i]['year'] - 2012;
            $orders_by_year_pretty[$position] = $orders_by_year[$i]['orders'];
            $amount_by_year_pretty[$position] = $amount_by_year[$i];
        }

        $id = Auth::id();
        $user = User::all()->where('id', $id);

        $orders_by_month_pretty = [];
        $amount_by_month_pretty = [];
        for ($i = 0; $i < 10; $i++) {
            $orders_by_month_pretty[] = ${'orders_by_month_pretty_' . (2012 + $i)};
            $amount_by_month_pretty[] = ${'amount_by_month_pretty_' . (2012 + $i)};
        };

        $data = [
            'orders_by_month_pretty' => $orders_by_month_pretty,
            'amount_by_month_pretty' => $amount_by_month_pretty,
            'orders_by_year_pretty' => $orders_by_year_pretty,
            'amount_by_year_pretty' => $amount_by_year_pretty,
            'user' => $user
        ];

        return view('admin.statistics.index',$data);
    }
}
