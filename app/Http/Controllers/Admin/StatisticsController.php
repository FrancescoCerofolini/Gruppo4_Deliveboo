<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Order;

class StatisticsController extends Controller
{
    public function index() {
        $orders = DB::table('orders')->whereYear('created_at', '=',2021)->get();
        
        //@dd($orders);
        return view('admin.statistics.index');
    }
}
