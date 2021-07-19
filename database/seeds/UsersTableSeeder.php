<?php

use App\User;
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
        
        factory(User::class)->create([
            'name'                  => 'Pablo',
            'lastname'              => 'Lires',
            'email'                 => 'pablolires@gmail.com',
            'role_id'               => 1,
            'points'                => 0,
            'confirmed'             => true,
            'email_verified_at'     => now(),
            'password'              => bcrypt('1234'), // password
            'remember_token'        => Str::random(10),
        ]);

        factory(User::class, 199)->create();
        
    }
}
