<?php
namespace API\Http\Controllers\API;

use League\Fractal\Manager;
use Illuminate\Http\Request;
use API\Http\Controllers\Controller;
use API\Http\Requests;
use API\Transformers\HotelTransformer;
use API\Transformers\Transformer;
use API\Transformers\Respond;
use Illuminate\Http\Response as HttpResponse;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\Cursor;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Flysystem\Exception;
use API\Builders\Builder;
use Config;

class HotelController extends Controller{
    
    private $fractal;
    private $hotelTransformer;
    
    function __construct(Manager $fractal, HotelTransformer $hotelTransformer){
        $this->fractal          = $fractal;
        $this->hotelTransformer = $hotelTransformer;
    }
    
    /*
     * This function responsible to return data from third party providers
     * city           example AMM
     * fromDate       example 2019-2-12
     * toDate         example 2019-2-15
     * numberOfAdults example 2
     */
    public function getHotels(Request $request){
        $responsData = array();
        try{
            $city     = $request->city;
            $fromDate = $request->fromDate;
            $toDate   = $request->toDate;
            $number   = $request->numberOfAdults;
            
            //user input validation should be here
            
            foreach(Config::get('custom.serviceCode') as $key=>$value){
                $builder     = new Builder();
                $response    = $builder->builder($value['case'],$value['api'],$request->all(),$value['method']);
                $responsData = array_merge($responsData,$response);
            }            
            
            //$this->sort($responsData);
            usort($responsData, function($a, $b) {
                return $a['rate'] <=> $b['rate'];
            });
            
            if(empty($responsData)){
                $customError   = Config::get('custom.customMessages')[2002]['customCode'];
                $customMessage = Config::get('custom.customMessages')[2002]['customMessage'];
                $statusCode    = HttpResponse::HTTP_OK;
            }else{
                $customError   = Config::get('custom.customMessages')[2001]['customCode'];
                $customMessage = Config::get('custom.customMessages')[2001]['customMessage'];
                $statusCode    = HttpResponse::HTTP_OK;
            }
        }catch(Exception $e){
            $customError   = Config::get('custom.mobileCustomErrors')[2003]['customCode'];
            $customMessage = Config::get('custom.mobileCustomErrors')[2003]['customMessage'];
            $statusCode    = HttpResponse::HTTP_SERVICE_UNAVAILABLE;
        }
        
        $transformer = new Transformer($responsData, $this->hotelTransformer,$this->fractal);
        $transformer->setStatusCode($statusCode);
        $transformer->setCustomCode($customError);
        $transformer->setCustomMessage($customMessage);
        return $transformer->respond('collection');     
    }
    
    private function sort($responsData){
        usort($responsData, function($a, $b) {
            return $a['fare'] <=> $b['fare'];
        });
    }
}

