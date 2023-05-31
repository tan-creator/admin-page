<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class DepartmentRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        return [
            'name' => 'required|max:100|not_regex:/\s{2,}/|unique:departments,name,'. $request->department ,
            'code' => 'required|numeric|max:2147483647|min:1|unique:departments,code,'. $request->department ,
            'note' => 'nullable|not_regex:/\s{2,}/|max:255',
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
            'code.max' => __('validation.numeric_max'),
            'code.min' => __('validation.numeric_min'),
            'name.not_regex' => __('validation.space_regex'),
            'note.not_regex' => __('validation.space_regex'),
        ];
    }

}
