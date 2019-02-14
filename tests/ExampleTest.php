<?php


use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase{
   
    public function testBasicExample(){
        $this->visit('/')
             ->see('Laravel 5');
    }
    
    public function testGetAllHotelsSuccess(){
        $response = $this->json('get', '/api/v1/hotels', ['city'=>'AMM','fromDate' => '2019-02-13', 'toDate' => '2019-02-14','numberOfAdults'=>2]);
        $response->assertStatus(200);
    }
    
    public function testGetAllHotelsPredefinedConditions(){
        $response = $this->json('get', '/api/v1/hotels', ['fromDate' => '2019-02-13', 'toDate' => '2019-02-14','numberOfAdults'=>2]);
        $response->assertStatus(200);
    }
    
    public function testTokenGenerationSuccessHotels(){
        $response = $this->json('POST', '/api/v1/token', ['username' => 'ramibadran.82@gmail.com', 'password' => 'test123']);      
        $response->assertStatus(200);
    }
    
    public function testTokenGenerationFailHotels(){
        $response = $this->json('POST', '/api/v1/token', ['username' => 'ramibadran.81@gmail.com', 'password' => 'test123']);
        $response->assertStatus(401);
    }
}
