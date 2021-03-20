<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['cat one', ' cat two'];

        foreach( $categories as $category){

          \App\Category::create([

            'name' => $category,

          ]);//end of create

        }//end of foreach
    }//end of run
}//end of seeder
