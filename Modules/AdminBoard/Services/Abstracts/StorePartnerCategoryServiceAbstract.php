<?php

namespace Modules\AdminBoard\Services\Abstracts;

use Illuminate\Http\Request;
use Modules\AdminBoard\Http\Models\AdminPartner;
use Modules\AdminBoard\Repositories\Interfaces\AdminCategoryInterface;

abstract class StorePartnerCategoryServiceAbstract
{
    public function __construct(AdminCategoryInterface $categoryRepository)
    {
    }

    abstract public function execute(Request $request, AdminPartner $partner);
}
