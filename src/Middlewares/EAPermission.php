<?php

namespace Shahab\EA\Middlewares;

use Closure;
use EAC;
use Shahab\EA\Exceptions\EANoAuthorizationException;
use Shahab\EA\Traits\Utility;
use Auth;

class EAPermission
{
    use Utility;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$entityFullyQualifiedName,$entitySearchField,$entitySearchValue)
    {
        $entity = $this->entityFactory($entityFullyQualifiedName,$entitySearchField,$entitySearchValue); 
        EAC::authorizePermission($entity,Auth::user());
        return $next($request);
    }
}
