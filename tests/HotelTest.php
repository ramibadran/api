<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HotelTest extends TestCase{
    /**
     * A basic test example.
     *
     * @return void
     */
    
    use WithoutMiddleware;
    
    public function testExample(){
        $this->get('/api/v1/hotels?city=AMM&fromDate=2019-02-13&toDate=2019-02-15&numberOfAdults=2')
        ->seeJsonStructure([
            '*' => [
                'provider', 'hotelName', 'rate'
            ]
        ]);
    }
}
