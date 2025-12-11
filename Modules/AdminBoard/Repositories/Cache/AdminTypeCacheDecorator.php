<?php

namespace Modules\AdminBoard\Repositories\Cache;

use Modules\AdminBoard\Repositories\Interfaces\AdminTypeInterface;
use Modules\KamrulDashboard\Repositories\Caches\CacheAbstractDecorator;

class AdminTypeCacheDecorator extends CacheAbstractDecorator implements AdminTypeInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAdminTypeBoard(array $filters = [], array $params = [])
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
    /**
         * {@inheritDoc}
         */
        public function getAdminType(array $filters = [], array $params = [])
        {
            return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
        }
        /**
         * {@inheritDoc}
         */
        public function getRelatedAdminType(int $adminId, int $limit = 4, array $with = [])
        {
            return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
        }
    /**
     * {@inheritDoc}
     */
    public function createSlug($name)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
