<?php

namespace Modules\LanguageAdvanced\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Modules\KamrulDashboard\Events\UpdatedContentEvent;
use Modules\KamrulDashboard\Events\UpdatedSlugEvent;
use Modules\KamrulDashboard\Http\Controllers\DboardController;
use Modules\KamrulDashboard\Http\Responses\DboardHttpResponse;
use Illuminate\Routing\Controller;
use Modules\KamrulDashboard\Packages\Facades\SlugHelperFacade;
use Modules\LanguageAdvanced\Http\Requests\LanguageAdvancedRequest;
use Modules\LanguageAdvanced\Packages\Supports\LanguageAdvancedManager;

class LanguageAdvancedController extends DboardController
{
    /**
     * @param int $id
     * @param LanguageAdvancedRequest $request
     * @param DboardHttpResponse $response
     * @return DboardHttpResponse
     */
    public function save($id, LanguageAdvancedRequest $request, DboardHttpResponse $response)
    {
        $model = $request->input('model');

        if (!class_exists($model)) {
            abort(404);
        }

        $data = (new $model)->findOrFail($id);

//        dd($request);
        LanguageAdvancedManager::save($data, $request);

        $request->merge([
            'is_slug_editable' => 0,
        ]);

        do_action(LANGUAGE_ADVANCED_ACTION_SAVED, $data, $request);

        event(new UpdatedContentEvent('', $request, $data));

        $slugId = $request->input('slug_id');

        $language = $request->input('language');

        if ($slugId && $language) {
            $table = 'slugs_translations';

            $condition = [
                'lang_code' => $language,
                'slugs_id' => $slugId,
            ];

            $slugData = array_merge($condition, [
                'key' => $request->input('slug'),
                'prefix' => SlugHelperFacade::getPrefix($model),
            ]);

            $translate = DB::table($table)->where($condition)->first();

            if ($translate) {
                DB::table($table)->where($condition)->update($slugData);
            } else {
                DB::table($table)->insert($slugData);
            }

            UpdatedSlugEvent::dispatch($data, $data->slugable);
        }

        return $this
            ->httpResponse()
            ->withUpdatedSuccessMessage();
//        return $response
//            ->setMessage(trans('kamruldashboard::lang.update_success_message'));
    }
}
