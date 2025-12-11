<?php

namespace Modules\Icon\Repositories\Cache;

use Modules\Icon\Repositories\Interfaces\IconInterface;
use Modules\KamrulDashboard\Repositories\Caches\CacheAbstractDecorator;

class IconCacheDecorator extends CacheAbstractDecorator implements IconInterface
{

    /**
     * {@inheritDoc}
     */
    public function createSlug($name)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
