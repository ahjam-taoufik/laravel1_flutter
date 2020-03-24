<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=\App\User::all();

         if ($users->count()==0){
             $this->command->info("please create some users");
             return;
         }


        $nbProd =(int)$this->command->ask("How many of product you want generate?",100);

        factory(App\Product::class,$nbProd)->make()->each(function ($post) use ($users){
            $post->user_id = $users->random()->id;
            $post->save();
        });
    }
}
