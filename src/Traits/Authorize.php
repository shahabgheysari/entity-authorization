<?php
namespace Shahab\EA\Traits;
use Shahab\EA\Exceptions\EANoAuthorizationException;

trait Authorize{

    /**
     * @param App\User $user
     */
    public function authorizeRole($user)
    { 
        $roles = $this->getRoles()->makeHidden('pivot')->toArray();
        if(!$user->is(array_pluck($roles,'id'))){
            throw new EANoAuthorizationException;
        }
        return true;
    }

      /**
     * @param App\User $user
     */
    public function authorizePermission($user)
    {
        $permissions = $this->getPermissions()->makeHidden('pivot')->toArray();
        if(!$user->can(array_pluck($permissions,'id'))){
            throw new EANoAuthorizationException;
        }
        return true;
    }
}