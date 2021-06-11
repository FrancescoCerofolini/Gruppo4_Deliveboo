<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Dish;

class DishSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $data = config("dish");
        for ($i = 0; $i < count($data[0]); $i++) {
            $newdish = new Dish;
            $newdish->name = $data[0][$i];
            $newdish->user_id = floor($i/5) + 1;
            $newdish->description = "allergeni: " . $data[1][rand(0, count($data[1]) -1)];
            $newdish->price = $faker->randomFloat(2, 1, 99);
            $newdish->visibility = true;
            $newdish->save();
        }
    }
}
