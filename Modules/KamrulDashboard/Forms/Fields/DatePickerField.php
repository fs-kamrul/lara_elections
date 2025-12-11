<?php

namespace Modules\KamrulDashboard\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;
use Assets;

class DatePickerField extends FormField
{
    protected function getTemplate(): string
    {

        Assets::addScriptsDirectly('vendor/Modules/KamrulDashboard/js/date-picker.js');

        return 'kamruldashboard::forms.fields.date-picker';
    }
}
