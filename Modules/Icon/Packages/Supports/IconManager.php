<?php

namespace Modules\Icon\Packages\Supports;

use Illuminate\Support\Manager;
use Modules\Icon\Packages\IconDriver;
use Modules\Icon\Packages\SvgDriver;

class IconManager extends Manager
{
    public function getDefaultDriver(): string
    {
        return 'svg';
    }

    public function createSvgDriver(): IconDriver
    {
        return app(SvgDriver::class)->setConfig(
            $this->config->get('Modules.Icon.icon', [])
        );
    }
}
