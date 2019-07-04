<?php
namespace Shahab\EA;

class EntityAuhorize{

    /**
     * @param App\User $user 
     * @param Illuminate\Database\Eloquent\Model $entity
     */
    public function authorizeRole($entity,$user)
    {
        return $entity->authorizeRole($user);
    }

     /**
     * @param App\User $user 
     * @param Illuminate\Database\Eloquent\Model $entity
     */
    public function authorizePermission($entity,$user)
    {
        return $entity->authorizePermission($user);
    }
}