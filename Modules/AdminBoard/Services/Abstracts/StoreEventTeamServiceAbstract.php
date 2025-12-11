<?php

namespace Modules\AdminBoard\Services\Abstracts;

use Illuminate\Http\Request;
use Modules\AdminBoard\Http\Models\AdminEvent;
use Modules\AdminBoard\Repositories\Interfaces\AdminTeamInterface;

abstract class StoreEventTeamServiceAbstract
{
    public function __construct(AdminTeamInterface $adminTeam)
    {
    }

    abstract public function execute(Request $request, AdminEvent $event);
}
