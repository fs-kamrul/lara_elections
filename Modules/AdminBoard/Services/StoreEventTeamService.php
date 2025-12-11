<?php

namespace Modules\AdminBoard\Services;

use Illuminate\Http\Request;
use Modules\AdminBoard\Http\Models\AdminEvent;
use Modules\AdminBoard\Services\Abstracts\StoreEventTeamServiceAbstract;

class StoreEventTeamService extends StoreEventTeamServiceAbstract
{
    public function execute(Request $request, AdminEvent $event): void
    {
        $teams = $request->input('teams', []);
        if (is_array($teams)) {
            if ($teams) {
                $event->teams()->sync($teams);
            } else {
                $event->teams()->detach();
            }
        }
    }
}
