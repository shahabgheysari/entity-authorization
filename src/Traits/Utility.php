<?php
namespace Shahab\EA\Traits;

trait Utility{

    public function entityFactory($entityFullyQualifiedName,$entitySearchField,$entitySearchValue)
    {
        return $entityFullyQualifiedName::get()->where($entitySearchField,$entitySearchValue)->first();
    }
    
}