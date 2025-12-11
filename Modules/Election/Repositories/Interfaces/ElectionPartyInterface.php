<?php

namespace Modules\Election\Repositories\Interfaces;

use Modules\KamrulDashboard\Repositories\Interfaces\RepositoryInterface;

interface ElectionPartyInterface extends RepositoryInterface
{
    public function getElectionParty(array $filters = [], array $params = []);
    public function getRelatedElectionParty(int $adminId, int $limit = 4, array $with = []);
    /**
     * @param string $name
     * @return mixed
     */
    public function createSlug($name);
}
