<?php

namespace Modules\KamrulDashboard\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;
use Assets;

class DateTimeField extends FormField
{
    protected function getTemplate(): string
    {

        Assets::addScriptsDirectly('vendor/Modules/KamrulDashboard/js/date-time.js');

        return 'kamruldashboard::forms.fields.date-time';
    }
}
