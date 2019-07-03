<?php

namespace Shahab\EA\Models;

use Illuminate\Database\Eloquent\Model;
use DCN\RBAC\Traits\HasRoleAndPermission as HasRoleAndPermissionTrait;
use DCN\RBAC\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Shahab\EA\Traits\Authorize;

class Page extends Model implements HasRoleAndPermissionContract
{
    use HasRoleAndPermissionTrait,Authorize;
    protected $fillable=['name'];
    protected $tablename="pages";
    //public $pivotTableName="permission_page";

    public function roles(){
        return $this->belongsToMany(config('rbac.models.role'),'role_page')->withPivot('granted');
    }

    public function permissions(){
        return $this->belongsToMany(config('rbac.models.permission'),'permission_page')->withPivot('granted');
    }

     /**
     * override RBAC trait function
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function userPermissions()
    {
        return $this->belongsToMany(config('rbac.models.permission'),'permission_page')->withTimestamps()->withPivot('granted');
    }
    
}
