<?php

namespace Modules\AdminBoard\Repositories\Interfaces;

use Modules\KamrulDashboard\Repositories\Interfaces\RepositoryInterface;

interface AdminPackageInterface extends RepositoryInterface
{
    public function getAdminPackageGroup(array $filters = [], array $params = []);
    public function getAdminPackage(array $filters = [], array $params = []);
    public function getRelatedAdminPackage(int $adminId, int $limit = 4, array $with = []);
    /**
     * @param string $name
     * @return mixed
     */
    public function createSlug($name);
}
