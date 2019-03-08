<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      =>  'Klinger dos Santos',
            'email'     =>  'kfsantos@uea.edu.br',
            'password'  =>  bcrypt('123456'),
        ]);   

        User::create([
            'name'      =>  'Fulano dos Santos',
            'email'     =>  'fulano@uea.edu.br',
            'password'  =>  bcrypt('123456'),
        ]); 
    }
}
