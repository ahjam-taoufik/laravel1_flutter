<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

          if($this->command->confirm("do you want to refresh the database ?")){
              $this->command->call("migrate:refresh");
              $this->command->info("database was refreshed !");
          }

        //vous pouvez rassembler les deux seeder
        $this ->call([
           UsersTableSeeder::class,
           ProductsTableSeeder::class
        ]);
        //$this->call(UsersTableSeeder::class);
        //$this->call(ProductsTableSeeder::class);
    }

}
