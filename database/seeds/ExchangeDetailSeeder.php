<?php

use App\Exchange;
use App\ExchangeDetail;
use Illuminate\Database\Seeder;

class ExchangeDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$exchanges = Exchange::all()->pluck('id');

    	foreach ($exchanges as $exchange_id) {

    		if ($exchange_id%2==0){

                factory(ExchangeDetail::class, 2)->create([
                    'exchange_id' => $exchange_id,
                ]);

			} else {

                factory(ExchangeDetail::class)->create([
                    'exchange_id' => $exchange_id,
                ]);

			}

    	}

    }
    
}





