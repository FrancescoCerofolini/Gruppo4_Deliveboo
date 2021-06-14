<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i= 0; $i < 20; $i++) {
            $neworder = new Order;
            $neworder->customer_address = $faker->address();
            $neworder->customer_email = $faker->email();
            $neworder->customer_phone = $faker->isbn10();
            $neworder->customer_name =$faker->name();
            $neworder->code = $faker->isbn10();
            $neworder->status = "paid";
            $neworder->amount = $faker->randomFloat(2, 1, 1000);
            $neworder->save();
        } 
    }
}
