<?php
namespace API\Http\Middleware;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Illuminate\Http\Response as HttpResponse;
use Response;
USE Config;

class CustomAuth{
    /**
     * The names of the route that should not pass to custom auth.
     *
     * @var array
     */
    protected $except = [
        //
    ];
    
    public function handle($request, \Closure $next){
        try {
            $token  = JWTAuth::getToken();
            $client = JWTAuth::toUser($token);
            
            if(empty($client)){
                return Response::json([
                    'custom_message' => Config::get('custom.customMessages')[2009]['customMessage'],
                    'custom_code'    => Config::get('custom.customMessages')[2009]['customCode'],
                    'data'           => [],
                ],HttpResponse::HTTP_UNAUTHORIZED);
            }
            
            //create new token and return it in the cureent respones
            $newToken = JWTAuth::refresh($token); 
            
            //send the refreshed token back to the clien
            $response = $next($request);
            $response->headers->set('Authorization',$newToken);
            return $response;
        }catch(TokenExpiredException $e) {
            return Response::json([
                'custom_message' => Config::get('custom.customMessages')[2004]['customMessage'],
                'custom_code'    => Config::get('custom.customMessages')[2004]['customCode'],
                'data'           => [],
            ],HttpResponse::HTTP_UNAUTHORIZED);
        }catch(TokenBlacklistedException $e) {
            return Response::json([
                'custom_message' => Config::get('custom.customMessages')[2005]['customMessage'],
                'custom_code'     => Config::get('custom.customMessages')[2005]['customCode'],
                'data'            => [],
            ],HttpResponse::HTTP_UNAUTHORIZED);
        }catch(TokenInvalidException $e) {
            return Response::json([
                'custom_message' => Config::get('custom.customMessages')[2006]['customMessage'],
                'custom_code'    => Config::get('custom.customMessages')[2006]['customCode'],
                'data'           => [],
            ],HttpResponse::HTTP_UNAUTHORIZED);
        }catch(JWTException $e) {
            return Response::json([
                'custom_message' => Config::get('custom.customMessages')[2007]['customMessage'],
                'custom_code'    => Config::get('custom.customMessages')[2007]['customCode'],
                'data'           => [],
            ],HttpResponse::HTTP_UNAUTHORIZED);
        }catch(Exception $e){
            return Response::json([
                'custom_message' => Config::get('custom.customMessages')[2008]['customMessage'],
                'custom_code'    => Config::get('custom.customMessages')[2008]['customCode'],
                'data'           => [],
            ],HttpResponse::HTTP_SERVICE_UNAVAILABLE);
        }
    }
}