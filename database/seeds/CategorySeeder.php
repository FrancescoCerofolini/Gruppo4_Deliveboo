<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\User;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Pizza','Cinese','Giapponese','Pesce','Messicano','Barbecue','Sushi','Gelato','Piadina','Hamburger','Panini','Colazione','Vegetariano','Vegano','Dessert','Greco','Americano','Italiano','Carne','Kebab','Osteria'];
        sort($categories);

        $user1 = User::all();
        $user2 = $user1->find('id');
        
        for ($i = 0; $i < count($categories); $i++) {
            $new_category = new Category();
            $new_category->name = $categories[$i];
            $new_category->users()->sync([1,2,3]);
            $new_category->save();
        }
    }
}
