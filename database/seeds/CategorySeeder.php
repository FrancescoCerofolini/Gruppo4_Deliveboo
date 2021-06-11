<?php

use Illuminate\Database\Seeder;
use App\Category;

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

        for ($i = 0; $i < count($categories); $i++) {
            $new_category = new Category();
            $new_category->name = $categories[$i];
            $new_category->save(); 
        }
    }
}
