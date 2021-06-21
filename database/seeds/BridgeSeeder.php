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
            $howMany = rand(1,5);
            $where = rand(0,4);
            $which = array_fill(0,$howMany,0);
            for ($i = 0; $i < $howMany; $i++) {
                $which[$i] = rand(1,5) + (5 * $where);
            }
            $order->dishes()->sync($which);
        }

    }
}
