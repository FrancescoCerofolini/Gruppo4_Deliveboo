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

        $current = Carbon::now()->format('d/m/Y');

        $data = [
            'user' => $user,
            'date_time' => $current,


        ];

        return view('admin.home', $data);
    }
}
