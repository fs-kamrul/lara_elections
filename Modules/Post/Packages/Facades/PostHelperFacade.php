<?php

namespace Modules\Post\Packages\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Post\Packages\Supports\PostHelper;

class PostHelperFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PostHelper::class;
    }
}
