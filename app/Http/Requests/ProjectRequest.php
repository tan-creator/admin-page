<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:100',
            'note' => 'nullable|max:255',
            'types' => [
                'required',
                Rule::in(['Other', 'Fixed Price', 'Body Shopping']),
            ],
            'status' => [
                Rule::in(['Other', 'Coming', 'On-going', 'Closed', 'Pending']),
            ],
            'begin_date' => 'required|date',
            'finish_date' => 'required|date|after_or_equal:begin_date',
            'customer_name' => 'required|max:100',
            'mm' => 'required|regex:/^\d{1,8}(\.\d{1,3})?$/',
        ];
    }

     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => __('validation.required'),
            'max' => __('validation.max'),
            'unique' => __('validation.unique'),
            'date' => __('validation.date'),
            'finish_date.after_or_equal' => __('validation.finish_date'),
            'mm.regex' => __('validation.mm_regex'),
        ];
    }
}
