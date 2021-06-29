<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $id = Auth::id();
        $user = User::all()->where('id', $id);

        $tot_orders = DB::table('order_dish')
            ->select(DB::raw('count(distinct(orders.id)) as tot_order'))
            ->join('dishes', 'order_dish.dish_id', '=', 'dishes.id')
            ->join('orders', 'order_dish.order_id', '=', 'orders.id')
            ->where('dishes.user_id', $id)
            ->get();
        // @dd($tot_orders[0]->tot_order);
        
        $tot_dishes = DB::table('dishes')
            ->select(DB::raw('count(dishes.id) as tot_dish'))
            ->where('dishes.user_id', $id)
            ->get();
        // @dd($tot_dish);

        $amounts = DB::table('order_dish')
            ->select(DB::raw('orders.amount,orders.id'))
            ->join('dishes', 'order_dish.dish_id', '=', 'dishes.id')
            ->join('orders', 'order_dish.order_id', '=', 'orders.id')
            ->where('dishes.user_id', $id)
            ->groupBy('orders.id')
            ->get();


        $tot_amount = 0;
        foreach ($amounts as $amount) {
            $tot_amount += $amount->amount;
        }
        //@dd($tot_amount);
        
        $data = [
            'user' => $user,
            'tot_orders' => $tot_orders,
            'tot_dishes' => $tot_dishes,
            'tot_amount' => $tot_amount

        ];
        return view('admin.home', $data);
    }
}
