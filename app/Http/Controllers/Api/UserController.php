<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller

{   

    public function restaurants_search($filter){
        
       $restaurants = DB::table('users')
       ->join('category_user', 'users.id', '=', 'category_user.user_id')
       ->join('categories', 'category_user.category_id', '=', 'categories.id')
       ->where('category_id', $filter)
       ->get();
        $data = [
            'response' => $restaurants
        ];
        return response()->json([
            'success' => true,
            'results' => $data,
        ]);
    }

}
