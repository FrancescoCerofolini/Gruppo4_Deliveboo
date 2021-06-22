<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        $data = config('user');
        
       for ($i = 0; $i < 10; $i ++) {
           $newUser = new User();
           $newUser->name = $data[0][$i];
           $newUser->email = $data[1][$i];
           $newUser->password = bcrypt($data[2][$i]);
           $newUser->address = $data[3][$i];
           $newUser->slug = $data[5][$i];
           $newUser->piva = $data[4][$i];
           $newUser->created_at = new DateTime('2012-01-01 00:00:00',null);
           $newUser->save();
        }
    }
}
