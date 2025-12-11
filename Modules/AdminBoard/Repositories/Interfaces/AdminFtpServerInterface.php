<?php

namespace Modules\AdminBoard\Repositories\Interfaces;

use Modules\KamrulDashboard\Repositories\Interfaces\RepositoryInterface;

interface AdminFtpServerInterface extends RepositoryInterface
{
    public function getAdminFtpserverGroup(array $filters = [], array $params = []);
    public function getAdminFtpServer(array $filters = [], array $params = []);
    public function getRelatedAdminFtpServer(int $adminId, int $limit = 4, array $with = []);
    /**
     * @param string $name
     * @return mixed
     */
    public function createSlug($name);
}
