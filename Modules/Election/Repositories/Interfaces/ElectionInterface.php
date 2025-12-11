<?php

namespace Modules\Election\Repositories\Interfaces;

use Modules\KamrulDashboard\Repositories\Interfaces\RepositoryInterface;

interface ElectionInterface extends RepositoryInterface
{
    public function getElection(array $filters = [], array $params = []);
    public function getRelatedElection(int $adminId, int $limit = 4, array $with = []);
    /**
     * @param string $name
     * @return mixed
     */
    public function createSlug($name);
}
