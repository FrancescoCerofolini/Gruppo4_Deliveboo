<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Order;
use App\User;
use App\Dish;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i= 0; $i < 10000; $i++) {
            $neworder = new Order;
            $neworder->customer_address = $faker->address();
            $neworder->customer_email = $faker->email();
            $neworder->customer_phone = $faker->isbn10();
            $neworder->customer_name =$faker->name();
            $neworder->code = $faker->isbn10();
            $neworder->status = "paid";
            $neworder->amount = 0;
            $neworder->created_at = $faker->dateTimeBetween($startDate = '2012-01-02', $endDate = 'now', $timezone = null);
            $neworder->save();
        } 
    }
}
