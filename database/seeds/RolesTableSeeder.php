<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(Role::class)->create([
            'name' => 'Administrador',
        ]);

        factory(Role::class)->create([
            'name' => 'Usuario',
        ]);
        
    }
}
