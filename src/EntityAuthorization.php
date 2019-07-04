<?php
namespace Shahab\EA;

class EntityAuthorization{

    /**
     * @param App\User $user 
     * @param Illuminate\Database\Eloquent\Model $entity
     */
    public static function authorizeRole($entity,$user)
    {
        return $entity->authorizeRole($user);
    }

     /**
     * @param App\User $user 
     * @param Illuminate\Database\Eloquent\Model $entity
     */
    public static function authorizePermission($entity,$user)
    {
        return $entity->authorizePermission($user);
    }
}