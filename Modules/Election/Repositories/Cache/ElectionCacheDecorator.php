<?php

namespace Modules\Election\Repositories\Cache;

use Modules\Election\Repositories\Interfaces\ElectionInterface;
use Modules\KamrulDashboard\Repositories\Caches\CacheAbstractDecorator;

class ElectionCacheDecorator extends CacheAbstractDecorator implements ElectionInterface
{
    /**
         * {@inheritDoc}
         */
        public function getElection(array $filters = [], array $params = [])
        {
            return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
        }
        /**
         * {@inheritDoc}
         */
        public function getRelatedElection(int $adminId, int $limit = 4, array $with = [])
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
