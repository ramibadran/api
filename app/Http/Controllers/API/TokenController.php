<?php
namespace API\Http\Controllers\API;

use League\Fractal\Manager;
use Illuminate\Http\Request;
use API\Http\Controllers\Controller;
use API\Http\Requests;
use API\Transformers\TokenTransformer;
use API\Transformers\Transformer;
use API\Transformers\Respond;
use Illuminate\Http\Response as HttpResponse;
use League\Fractal\Resource\Collection;
use DB;
use League\Fractal\Pagination\Cursor;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Flysystem\Exception;
use Illuminate\Database\QueryException;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Config;
use API\Mode\Client;


class TokenController extends Controller{
    private $fractal;
    private $tokenTransfromer;
    
    function __construct(Manager $fractal, TokenTransformer $tokenTransfromer){
        $this->fractal          = $fractal;
        $this->tokenTransfromer = $tokenTransfromer;
    }
    
    public function token(Request $request){
        $data = array();
        try{
            $userIp      = $request->header('USER-IP');
            $deviceAgent = $request->header('USER-DEVICE-AGENT');
            if(trim($userIp) == ''){
                $customError   = Config::get('custom.customMessages')[2010]['customCode'];
                $customMessage = Config::get('custom.customMessages')[2010]['customMessage'];
                $statusCode    = HttpResponse::HTTP_PRECONDITION_FAILED;
            }elseif(trim($deviceAgent) == ''){
                $customError   = Config::get('custom.customMessages')[2011]['customCode'];
                $customMessage = Config::get('custom.customMessages')[2011]['customMessage'];
                $statusCode    = HttpResponse::HTTP_PRECONDITION_FAILED;
            }else{
                $username = trim($request->username);
                $password = trim($request->password);
                
                if($username == '' || $password == ''){
                    $customError   = Config::get('custom.customMessages')[2013]['customCode'];
                    $customMessage = Config::get('custom.customMessages')[2013]['customMessage'];
                    $statusCode    = HttpResponse::HTTP_PRECONDITION_FAILED;
                }else{
                    $client = Client::where('username','=',$username)->where('password','=',$password)->where('status','=',1)->first();
                    if(is_null($client)){
                        $customError   = Config::get('custom.customMessages')[2012]['customCode'];
                        $customMessage = Config::get('custom.customMessages')[2012]['customMessage'];
                        $statusCode    = HttpResponse::HTTP_UNAUTHORIZED;
                    }else{
                        $token = JWTAuth::fromUser($client);
                        
                        if(!$token) {
                            $customError   = Config::get('custom.customMessages')[2012]['customCode'];
                            $customMessage = Config::get('custom.customMessages')[2012]['customMessage'];
                            $statusCode    = HttpResponse::HTTP_NO_CONTENT;
                        }else{
                            $data['token'] = (string)$token;
                            $customError   = Config::get('custom.customMessages')[2014]['customCode'];
                            $customMessage = Config::get('custom.customMessages')[2014]['customMessage'];
                            $statusCode    = HttpResponse::HTTP_CREATED;
                        }
                    }
                }
            }
        }catch(TokenExpiredException $e) {
            $customError   = Config::get('custom.customMessages')[2009]['customCode'];
            $customMessage = Config::get('custom.customMessages')[2009]['customMessage'];
            $statusCode    = HttpResponse::HTTP_UNAUTHORIZED;
        }catch(TokenBlacklistedException $e) {
            $customError   = Config::get('custom.customMessages')[2010]['customCode'];
            $customMessage = Config::get('custom.customMessages')[2010]['customMessage'];
            $statusCode    = HttpResponse::HTTP_UNAUTHORIZED;
        }catch(TokenInvalidException $e) {
            $customError   = Config::get('custom.customMessages')[2011]['customCode'];
            $customMessage = Config::get('custom.customMessages')[2011]['customMessage'];
            $statusCode    = HttpResponse::HTTP_UNAUTHORIZED;
        }catch(JWTException $e) {
            $customError   = Config::get('custom.customMessages')[2012]['customCode'];
            $customMessage = Config::get('custom.customMessages')[2012]['customMessage'];
            $statusCode    = HttpResponse::HTTP_UNAUTHORIZED;
        }catch(QueryException $e){
            $customError   = Config::get('custom.customMessages')[2002]['customCode'];
            $customMessage = Config::get('custom.customMessages')[2002]['customMessage'];
            $statusCode    = HttpResponse::HTTP_SERVICE_UNAVAILABLE;
        }catch(Exception $e){
            $customError   = Config::get('custom.customMessages')[2013]['customCode'];
            $customMessage = Config::get('custom.customMessages')[2013]['customMessage'];
            $statusCode    = HttpResponse::HTTP_SERVICE_UNAVAILABLE;
        }
        
        $transformer = new Transformer($data,$this->tokenTransfromer,$this->fractal);
        $transformer->setStatusCode($statusCode);
        $transformer->setCustomCode($customError);
        $transformer->setCustomMessage($customMessage);
        return $transformer->respond('collection');
    }
}