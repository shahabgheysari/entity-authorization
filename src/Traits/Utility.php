<?php
namespace Shahab\EA\Traits;
use Shahab\EA\Exceptions\EAEntityNotFoundException;

trait Utility{

    public function entityFactory($entityFullyQualifiedName,$entitySearchField,$entitySearchValue)
    {
        $entity = $entityFullyQualifiedName::get()->where($entitySearchField,$entitySearchValue)->first();
        if(!$entity){
            throw new EAEntityNotFoundException;
        } 
        return $entity;
    }
    
}