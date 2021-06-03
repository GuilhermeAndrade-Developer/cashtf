<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
        ['id' => 1, 'name' => 'Adriano Christian', 'email' => 'adriano@peexell.com.br', 'password' =>  bcrypt('teste')]
        ]);
    }
}
