<?php
namespace Shahab\EA;

use Shahab\EA\Models\Page;
use Auth;


class EntityAuthorization{

    /**
     * @param App\User $user 
     * @param Illuminate\Database\Eloquent\Model $entity
     */
    public  function authorizeRole($entity,$user)
    {
        return $entity->authorizeRole($user);
    }

     /**
     * @param App\User $user 
     * @param Illuminate\Database\Eloquent\Model $entity
     */
    public  function authorizePermission($entity,$user)
    {
        return $entity->authorizePermission($user);
    }

    public function bladePageRole($pageName){ 
        return $this->authorizeRole(Page::get()->where('name',$pageName)->first(),Auth::User());
    }
}