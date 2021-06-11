<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
           $newUser->save();
        }

    }
}
