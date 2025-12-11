<?php

namespace Modules\AdminBoard\Repositories\Interfaces;

use Modules\KamrulDashboard\Repositories\Interfaces\RepositoryInterface;

interface AdminServiceInterface extends RepositoryInterface
{
    public function getAdminServiceGroup(array $filters = [], array $params = []);
    public function getAdminService(array $filters = [], array $params = []);
    public function getRelatedAdminService(int $adminId, int $limit = 4, array $with = []);
    /**
     * @param string $name
     * @return mixed
     */
    public function createSlug($name);
}
