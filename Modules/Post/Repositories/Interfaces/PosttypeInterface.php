<?php

namespace Modules\Post\Repositories\Interfaces;

use Modules\KamrulDashboard\Repositories\Interfaces\RepositoryInterface;

interface PosttypeInterface extends RepositoryInterface
{

    public function getType(array $filters = [], array $params = []);
}
