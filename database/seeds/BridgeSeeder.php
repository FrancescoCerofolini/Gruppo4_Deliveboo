<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use App\Order;
use Illuminate\Support\Facades\DB;

class BridgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //user-category

        $users = User::all();

        foreach ($users as $user) {
            switch ($user->id) {
                case 1:
                    $user->categories()->sync([11,18]);
                    break;
                case 2:
                    $user->categories()->sync([13]);
                    break;
                case 3:
                    $user->categories()->sync([4]);
                    break;
                case 4:
                    $user->categories()->sync([11,16]);
                    break;
                case 5:
                    $user->categories()->sync([9,12]);
                    break;
                case 6:
                    $user->categories()->sync([5]);
                    break;
                case 7:
                    $user->categories()->sync([11,18]);
                    break;
                case 8:
                    $user->categories()->sync([3,11,14]);
                    break;
                case 9:
                    $user->categories()->sync([11,16]);
                    break;
                case 10:
                    $user->categories()->sync([19]);
                    break;
            }           
        }

        //order-dish

        $orders = Order::all();

        foreach ($orders as $order) {
            switch ($order->id) {
                case 1:
                    $order->dishes()->sync([2,3,4]);
                    break;
                case 2:
                    $order->dishes()->sync([11,12]);
                    break;
                case 3:
                    $order->dishes()->sync([15]);
                    break;
                case 4:
                    $order->dishes()->sync([21,22]);
                    break;
                case 5:
                    $order->dishes()->sync([1,2]);
                    break;
                case 6:
                    $order->dishes()->sync([23,25]);
                    break;
                case 7:
                    $order->dishes()->sync([18,19,20]);
                    break;
                case 8:
                    $order->dishes()->sync([12,14]);
                    break;
                case 9:
                    $order->dishes()->sync([11,15]);
                    break;
                case 10:
                    $order->dishes()->sync([19]);
                    break;
                case 11:
                    $order->dishes()->sync([18]);
                    break;
                case 12:
                    $order->dishes()->sync([7,8]);
                    break;
                case 13:
                    $order->dishes()->sync([21,24]);
                    break;
                case 14:
                    $order->dishes()->sync([11,16]);
                    break;
                case 15:
                    $order->dishes()->sync([9,12]);
                    break;
                case 16:
                    $order->dishes()->sync([5]);
                    break;
                case 17:
                    $order->dishes()->sync([11,18]);
                    break;
                case 18:
                    $order->dishes()->sync([3,11,14]);
                    break;
                case 19:
                    $order->dishes()->sync([11,16]);
                    break;
                case 20:
                    $order->dishes()->sync([19]);
                    break;
            }           
        }

    }
}
