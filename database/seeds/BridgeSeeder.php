<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use App\Order;

class BridgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

    }
}
