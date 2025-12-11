<?php

namespace Modules\AdminBoard\Services;

use Illuminate\Http\Request;
use Modules\AdminBoard\Http\Models\AdminFtpServer;
use Modules\AdminBoard\Services\Abstracts\StoreFtpServerCategoryServiceAbstract;

class StoreFtpServerCategoryService extends StoreFtpServerCategoryServiceAbstract
{
    public function execute(Request $request, AdminFtpServer $ftpServer): void
    {
        $categories = $request->input('categories', []);
        if (is_array($categories)) {
            if ($categories) {
                $ftpServer->categories()->sync($categories);
            } else {
                $ftpServer->categories()->detach();
            }
        }
    }
}
