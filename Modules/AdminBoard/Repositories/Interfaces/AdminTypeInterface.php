<?php

namespace Modules\AdminBoard\Repositories\Interfaces;

use Modules\KamrulDashboard\Repositories\Interfaces\RepositoryInterface;

interface AdminTypeInterface extends RepositoryInterface
{
    public function getAdminTypeBoard(array $filters = [], array $params = []);
    public function getAdminType(array $filters = [], array $params = []);
    public function getRelatedAdminType(int $adminId, int $limit = 4, array $with = []);
    /**
     * @param string $name
     * @return mixed
     */
    public function createSlug($name);
}
