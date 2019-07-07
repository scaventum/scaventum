<?php namespace Scv\FacelessApi\Classes;

use Closure;
use Response;

use Scv\FacelessApi\Models\Client;

class ApiMiddleware
{
    public function handle($request, Closure $next)
    {   
        if($request->getMethod() == 'POST'){
            
            $client = Client::where('key',$request['client_key'])->where('active',1)->first();

            if (!$client) {
                return Response::make( 'Unauthorized or Inactive Client Key' , 401 );
            }
        }

        return $next($request);
    }
}