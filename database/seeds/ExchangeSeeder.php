<?php

use App\User;
use App\Exchange;
use Illuminate\Database\Seeder;

class ExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total_users = User::all()->count();

    	for ($i=2; $i <= $total_users ; $i++) { 
    		factory(Exchange::class)->create([
    			'user_id' => $i,
    		]);
    	}

    }
}
