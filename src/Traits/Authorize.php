<?php
namespace Shahab\EA\Traits;

trait Authorize{

    /**
     * @param App\User $user
     */
    public function authorizeRole($user)
    {
        $roles = $this->getRoles()->makeHidden('pivot')->toArray();
        return $user->is(array_pluck($roles,'id'));
    }

      /**
     * @param App\User $user
     */
    public function authorizePermission($user)
    {
        $permissions = $this->getPermissions()->makeHidden('pivot')->toArray();
        return $user->can(array_pluck($permissions,'id'));
    }
}