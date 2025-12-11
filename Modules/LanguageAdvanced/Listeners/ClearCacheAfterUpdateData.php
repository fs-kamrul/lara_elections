<?php

namespace Modules\LanguageAdvanced\Listeners;


use Modules\KamrulDashboard\Events\UpdatedContentEvent;
use Modules\KamrulDashboard\Http\Models\DboardModel;
use Modules\KamrulDashboard\Services\Cache\Cache;

class ClearCacheAfterUpdateData
{
    public function handle(UpdatedContentEvent $event): void
    {
        if (! setting('enable_cache', false) || ! $event->data instanceof DboardModel) {
            return;
        }

        $cache = new Cache(app('cache'), $event->data::class);
        $cache->flush();
    }
}
