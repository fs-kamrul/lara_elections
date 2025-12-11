<?php

namespace Modules\AdminBoard\Packages\Facades;

use Illuminate\Support\Facades\Facade;

class AdminBoardGraphFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'adminboardgraph';
    }
}
