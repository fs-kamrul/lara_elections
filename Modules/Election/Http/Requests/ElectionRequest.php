<?php

namespace Modules\Election\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Election\Enums\ElectionStatusEnum;
use Modules\KamrulDashboard\Http\Requests\Request;

class ElectionRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:120',
            'short_description' => 'required|string|max:160',
            'description' => 'nullable|string|max:400',
            'status' => Rule::in(ElectionStatusEnum::values()),
        ];
    }

    public function attributes(): array
    {
        return [
            'custom_fields.*.name' => trans('election::custom-fields.name'),
            'custom_fields.*.value' => trans('election::custom-fields.name'),
        ];
    }
}
