<?php

namespace Modules\Election\Repositories\Cache;

use Modules\Election\Repositories\Interfaces\ElectionPartyInterface;
use Modules\KamrulDashboard\Repositories\Caches\CacheAbstractDecorator;

class ElectionPartyCacheDecorator extends CacheAbstractDecorator implements ElectionPartyInterface
{
    /**
         * {@inheritDoc}
         */
        public function getElectionParty(array $filters = [], array $params = [])
        {
            return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
        }
        /**
         * {@inheritDoc}
         */
        public function getRelatedElectionParty(int $adminId, int $limit = 4, array $with = [])
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
