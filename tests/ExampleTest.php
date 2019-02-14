<?php


use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase{
   
    public function testBasicExample(){
        $this->visit('/')
             ->see('Laravel 5');
    }
    
    public function testSuccessCase(){
        $this->json('get', '/api/v1/hotels')
        ->assertStatus(200)
        ->assertJson([
            'city'           => 'AMM',
            'fromDate'       => '2019-02-13',
            'toDate'         => '2019-02-14',
            'numberOfAdults' => 2
        ]);
    }
    
    public function testMissingInputCase(){
        $this->json('get', '/api/v1/hotels')
        ->assertStatus(412)
        ->assertJson([
            'fromDate'       => '2019-02-13',
            'toDate'         => '2019-02-14',
            'numberOfAdults' => 2
        ]);
    }
}
