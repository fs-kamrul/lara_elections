<?php

namespace Modules\Election\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Election\Enums\ElectionPartyStatusEnum;
use Modules\KamrulDashboard\Http\Requests\Request;

class ElectionPartyRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:120',
            'short_description' => 'required|string|max:160',
            'description' => 'nullable|string|max:400',
            'status' => Rule::in(ElectionPartyStatusEnum::values()),
        ];
    }

    public function attributes(): array
    {
        return [
            'custom_fields.*.name' => trans('electionparty::custom-fields.name'),
            'custom_fields.*.value' => trans('electionparty::custom-fields.name'),
        ];
    }
}
