<?php
namespace API\Builders;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use League\Flysystem\Exception;
use API\Utilities\Logger;

/**
 * Class RestCaller.
 *
 * @package API\Builders
 *
 * @author Rami Badran <ramibadran_82@gmail.com>
 */


abstract class RestCaller{
	private $client;
	private $sslVerify;
	const TIME_OUT = 10;
	
	function __construct() {
		$this->sslVerify = true;
		if(config('custom.appEnv') != 'production'){
			$this->sslVerify = false;
		}
		$this->client  = new Client(['timeout' => self::TIME_OUT,'base_uri' => config('custom.apiBaseURL'),'exceptions' => false,'verify' => $this->sslVerify]);
    }
   
    protected function callRest($url,$query,$method){
		$logger = new Logger();
		try{
            if($method == 'Post'){
                $response = $this->client->request($method,$url,['connect_timeout' => self::TIME_OUT,'body' => $body]);
		    }else{
		        $response = $this->client->request($method,$url.'?'.$query,['connect_timeout' => self::TIME_OUT]);
		    }
		    
   			if($response->getStatusCode() != 200){
   			    throw new Exception('Rest API ' . $url . ' not exsist/valid api ' . $response->getStatusCode());
   			}else{
   			    return json_decode($response->getBody()->getContents(),true);
   			} 		  
   		}catch(Exception $e){
   		    $logger->logMe($e->getMessage() ,'RestAPIFail');
   			return null;
   		}
	} 
}