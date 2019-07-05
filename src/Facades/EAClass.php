<?php

namespace Shahab\EA\Facades;

use Illuminate\Support\Facades\Facade;

class EACLass extends Facade{

protected static function getFacadeAccessor()
{ 
     return 'EAC'; 
}
 
}