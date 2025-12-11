<?php

namespace Modules\Admission\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Admission\Http\Models\Admission;
use Modules\Admission\Repositories\Cache\AdmissionCacheDecorator;
use Modules\Admission\Repositories\Eloquent\AdmissionRepository;
use Modules\Admission\Repositories\Interfaces\AdmissionInterface;
//add_new_line_Interface_and_Repository_call

class HookServiceProvider extends ServiceProvider
{

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(AdmissionInterface::class, function () {
            return new AdmissionCacheDecorator(
                new AdmissionRepository(new Admission)
            );
        });
//add_new_line_Interface_and_Repository_to_hook
    }
}
