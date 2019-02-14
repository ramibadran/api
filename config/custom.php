<?php
return [

/*
|--------------------------------------------------------------------------
| Default custom configration
|--------------------------------------------------------------------------
|
*/
	'apiLogDir'   => env('API_LOG_PATH', '/logs/api_logs'),
	'unitTestDir' => env('UNIT_TEST_PATH', '/logs/unit-test-reporter'),
	'appEnv'      => env('APP_ENV','production'),
	'apiBaseURL'  => env('API_BASE_URL','http://127.0.0.1:8000/api/third_part/'),
 
 'customMessages'=> [
          2001 => ['customCode'=>'2001','customMessage' => 'Hotels returned Successfully'],
          2002 => ['customCode'=>'2002','customMessage' => 'Data Not Available'],
          2003 => ['customCode'=>'2003','customMessage' => 'something went wrong'],
          2004 => ['customCode'=>'2004','customMessage' => 'token expired,please Login'],
          2005 => ['customCode'=>'2005','customMessage' => 'token blacklisted,please Login again'],
          2006 => ['customCode'=>'2006','customMessage' => 'token invalid,please Login again'],
          2007 => ['customCode'=>'2007','customMessage' => 'token missing,please Login again'],
          2008 => ['customCode'=>'2008','customMessage' => 'something went wrong'],
          2009 => ['customCode'=>'2009','customMessage' => 'client not login'],
          2010 => ['customCode'=>'2010','customMessage' => 'User ip not provided or empty in the header'],
          2011 => ['customCode'=>'2011','customMessage' => 'Device agent not provided or empty in the header'],
          2012 => ['customCode'=>'2012','customMessage' => 'client not found'],
          2013 => ['customCode'=>'2013','customMessage' => 'There is missing parameter in the request'],
          2014 => ['customCode'=>'2014','customMessage' => 'client login successfully'],
          2015 => ['customCode'=>'2015','customMessage' => 'empty or invalid parameter'],
 ],
    
 'serviceCode' => [
        '0' => ['case'=>'bestHotel','api'=>'http://localhost:8080/third_part/est-hotels','method'=>'GET'],
        '1' => ['case'=>'crazyHotel','api'=>'http://localhost:8080/third_part/crazy-hotel','method'=>'GET'],
  ],
];
