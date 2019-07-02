<?php

namespace Shahab\PA\Models;

use Illuminate\Database\Eloquent\Model;
use DGacl\Traits\hasRoleAndPermission;
use DCN\RBAC\Traits\HasRoleAndPermission as HasRoleAndPermissionTrait;
use DCN\RBAC\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

class Page extends Model implements HasRoleAndPermissionContract
{
    use HasRoleAndPermissionTrait;
    protected $fillable=['name'];
    protected $tablename="pages";
    public $pivotTableName="permission_page";

    public function roles(){
        return $this->belongsToMany(config('rbac.models.role'),'role_page')->withTimestamps()->withPivot('granted');
    }

    public function permissions(){
        return $this->belongsToMany(config('rbac.models.permission'),'permission_page')->withTimestamps()->withPivot('granted');
    }
    
}
