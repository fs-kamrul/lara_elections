<?php

namespace Modules\Icon\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Icon\Http\Models\Icon;
use Modules\Icon\Repositories\Cache\IconCacheDecorator;
use Modules\Icon\Repositories\Eloquent\IconRepository;
use Modules\Icon\Repositories\Interfaces\IconInterface;
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
        $this->app->bind(IconInterface::class, function () {
            return new IconCacheDecorator(
                new IconRepository(new Icon)
            );
        });
//add_new_line_Interface_and_Repository_to_hook
    }
}
