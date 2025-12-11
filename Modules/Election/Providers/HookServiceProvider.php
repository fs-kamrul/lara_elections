<?php

namespace Modules\Election\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Election\Http\Models\Election;
use Modules\Election\Repositories\Cache\ElectionCacheDecorator;
use Modules\Election\Repositories\Eloquent\ElectionRepository;
use Modules\Election\Repositories\Interfaces\ElectionInterface;
//add_new_line_Interface_and_Repository_call
use Modules\Election\Http\Models\ElectionParty;
use Modules\Election\Repositories\Eloquent\ElectionPartyRepository;
use Modules\Election\Repositories\Interfaces\ElectionPartyInterface;
use Modules\Election\Repositories\Cache\ElectionPartyCacheDecorator;

class HookServiceProvider extends ServiceProvider
{

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ElectionInterface::class, function () {
            return new ElectionCacheDecorator(
                new ElectionRepository(new Election)
            );
        });
//add_new_line_Interface_and_Repository_to_hook
        $this->app->bind(ElectionPartyInterface::class, function () {
            return new ElectionPartyCacheDecorator(
                new ElectionPartyRepository(new ElectionParty)
            );
        });


    }
}


