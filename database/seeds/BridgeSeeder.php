<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use App\Order;
use App\Dish;
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
                case 11:
                    $user->categories()->sync([11,16,3,21]);
                    break;
                case 12:
                    $user->categories()->sync([1,2,3]);
                    break;
                case 13:
                    $user->categories()->sync([1,2,3]);
                    break;
                case 14:
                    $user->categories()->sync([5,6]);
                    break;
                case 15:
                    $user->categories()->sync([5,6]);
                    break;
                case 16:
                    $user->categories()->sync([7,6]);
                    break;
                case 17:
                    $user->categories()->sync([7,6]);
                    break;
                case 18:
                    $user->categories()->sync([19,8,16]);
                    break;
                case 19:
                    $user->categories()->sync([9]);
                    break;
                case 20:
                    $user->categories()->sync([12]);
                    break;
                case 21:
                    $user->categories()->sync([10,21,20]);
                    break;
                case 22:
                    $user->categories()->sync([11,14,3]);
                    break;
                case 23:
                    $user->categories()->sync([13]);
                    break;
                case 24:
                    $user->categories()->sync([15]);
                    break;
                case 25:
                    $user->categories()->sync([11,6]);
                    break;
                case 26:
                    $user->categories()->sync([17]);
                    break;
                case 27:
                    $user->categories()->sync([20,21,11]);
                    break;
                case 28:
                    $user->categories()->sync([20,21]);
                    break;
                case 29:
                    $user->categories()->sync([20,21,6]);
                    break;
                case 30:
                    $user->categories()->sync([21,11,14]);
                    break;
                case 31:
                    $user->categories()->sync([20,21,6]);
                    break;
                case 32:
                    $user->categories()->sync([12]);
                    break;
                case 33:
                    $user->categories()->sync([12,20,21]);
                    break;
                case 34:
                    $user->categories()->sync([11,16]);
                    break;
                case 35:
                    $user->categories()->sync([11,3,14]);
                    break;
                case 36:
                    $user->categories()->sync([10]);
                    break;
                case 37:
                    $user->categories()->sync([19,8]);
                    break;
                case 38:
                    $user->categories()->sync([18,11]);
                    break;
                case 39:
                    $user->categories()->sync([11,14,3]);
                    break;
                case 40:
                    $user->categories()->sync([11,14,3,16]);
                    break;
                case 41:
                    $user->categories()->sync([5,6]);
                    break;
                case 42:
                    $user->categories()->sync([1,2,10]);
                    break;
                case 43:
                    $user->categories()->sync([5,6]);
                    break;
                case 44:
                    $user->categories()->sync([18,11]);
                    break;
                case 45:
                    $user->categories()->sync([18,11,16]);
                    break;
                case 46:
                    $user->categories()->sync([4]);
                    break;
                case 47:
                    $user->categories()->sync([4]);
                    break;
                case 48:
                    $user->categories()->sync([4,19,8]);
                    break;
                case 49:
                    $user->categories()->sync([10,20,21]);
                    break;
                case 50:
                    $user->categories()->sync([5,6]);
                    break;
                }           
        }

        //order-dish

        $orders = Order::all();
        $counter = 0;

        foreach ($orders as $order) {
            $counter += 1;
            $howMany = rand(1,5);
            $where = rand(0,49);
            $which = array_fill(0,$howMany,0);
            $priceDB = [];
            $price = [];
            for ($i = 0; $i < $howMany; $i++) {
                do {
                    $number = rand(1,5) + (5 * $where);
                } while (in_array($number,$which));
                $which[$i] = $number;
                $priceDB[$i] = DB::table('dishes')->selectRaw('price')->where('id','=',$which[$i])->get();
                $price[$i] = floatval(json_decode($priceDB[$i],true)[0]['price']);
                $order->amount += $price[$i];
                $order->save();
            }

            $order->dishes()->sync($which);
            $order->amount += 3.00;

            $order->save();
        }

    }
}
