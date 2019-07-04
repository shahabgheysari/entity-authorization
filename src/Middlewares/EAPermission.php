<?php

namespace Shahab\EA\Middlewares;

use Closure;
use Shahab\EA\EntityAuthorization;
use Shahab\EA\Exceptions\EANoAuthorizationException;
use Shahab\EA\Exceptions\EAEntityNotFoundException;
use Auth;

class EAPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$entityFullyQualifiedName,$entitySearchField,$entitySearchValue)
    {
        $entity = $entityFullyQualifiedName::get()->where($entitySearchField,$entitySearchValue)->first();
        if(!$entity){
            throw new EAEntityNotFoundException;
        }
        if(!EntityAuthorization::authorizePermission($entity,Auth::user()))
        {
            throw new EANoAuthorizationException;
        }
        return $next($request);
    }
}
