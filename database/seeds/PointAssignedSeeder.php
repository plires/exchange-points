<?php

use App\PointAssigned;
use Illuminate\Database\Seeder;

class PointAssignedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	for ($i=2; $i <= 50 ; $i++) { 

	      factory(PointAssigned::class)->create([
	      	'user_id' => $i
	      ]);

    	}

    }
}
