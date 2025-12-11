<?php

namespace Modules\AdminBoard\Services\Abstracts;

use Illuminate\Http\Request;
use Modules\AdminBoard\Http\Models\AdminEvent;
use Modules\AdminBoard\Http\Models\AdminFtpServer;
use Modules\AdminBoard\Repositories\Interfaces\AdminCategoryInterface;

abstract class StoreFtpServerCategoryServiceAbstract
{
    public function __construct(AdminCategoryInterface $categoryRepository)
    {
    }

    abstract public function execute(Request $request, AdminFtpServer $ftpServer);
}
