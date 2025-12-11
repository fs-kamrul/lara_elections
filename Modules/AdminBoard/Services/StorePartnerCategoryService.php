<?php

namespace Modules\AdminBoard\Services;

use Illuminate\Http\Request;
use Modules\AdminBoard\Http\Models\AdminPartner;
use Modules\AdminBoard\Services\Abstracts\StorePartnerCategoryServiceAbstract;

class StorePartnerCategoryService extends StorePartnerCategoryServiceAbstract
{
    public function execute(Request $request, AdminPartner $partner): void
    {
        $categories = $request->input('categories', []);
        if (is_array($categories)) {
            if ($categories) {
                $partner->categories()->sync($categories);
            } else {
                $partner->categories()->detach();
            }
        }
    }
}
