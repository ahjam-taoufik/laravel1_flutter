<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $users=(int)$this->command->ask("How many of user you want generate?",20);
        factory(App\User::class,$users)->create();
    }
}
