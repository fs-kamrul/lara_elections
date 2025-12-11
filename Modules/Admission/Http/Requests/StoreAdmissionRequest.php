<?php

namespace Modules\Admission\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admission\Rules\ImageDimensions;

class StoreAdmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_nane' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'pre_institution' => 'required|string|max:255',
            'pre_gpa' => 'required|string|max:255',
            'pre_address' => 'required|string|max:255',
            'pre_postcode' => 'required|string|max:255',
//            'photo' => 'required|image|mimes:jpeg,jpg,png|max:150',
            'photo' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:150',
                new ImageDimensions(300, 300), // Adjust the dimensions as needed
            ],
        ];
    }
}
