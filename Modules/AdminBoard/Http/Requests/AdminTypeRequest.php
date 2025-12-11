<?php

namespace Modules\AdminBoard\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\AdminBoard\Enums\AdminTypeStatusEnum;
use Modules\KamrulDashboard\Http\Requests\Request;

class AdminTypeRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:120',
            'short_description' => 'required|string|max:160',
            'description' => 'nullable|string|max:400',
            'status' => Rule::in(AdminTypeStatusEnum::values()),
        ];
    }

    public function attributes(): array
    {
        return [
            'custom_fields.*.name' => trans('admintype::custom-fields.name'),
            'custom_fields.*.value' => trans('admintype::custom-fields.name'),
        ];
    }
}
