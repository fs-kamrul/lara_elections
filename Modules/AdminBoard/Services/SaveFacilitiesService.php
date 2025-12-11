<?php

namespace Modules\AdminBoard\Services;

use Modules\AdminBoard\Http\Models\AdminFacility;
use Modules\AdminBoard\Http\Models\AdminPackage;

class SaveFacilitiesService
{
    public function execute(AdminPackage $item, $facilities): void
    {
        if (! $facilities || ! is_array($facilities)) {
            return;
        }

        $facilitiesToSync = [];

        $item->admin_facilities()->detach();

        foreach ($facilities as $facility) {
            if (empty($facility['id']) || $facility['id'] == '0') {
                continue;
            }
//            dd($facilitie);

            $facilitiesToSync[$facility['id']] = [
//                'name_title' => $facility['name_title'],
            ];
        }

        if (empty($facilitiesToSync)) {
            return;
        }

        $item->admin_facilities()->syncWithoutDetaching($facilitiesToSync);
    }
}
