<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'currentPass' => 'current_password',
            'newPass' => [
                'required',
                'min:8',
                'max:25',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#])(?=.*[0-9])(?=[^\s])/',
            ],
            'confirmPassword' => "required",
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
            'min' => __('validation.min'),
            'newPass.regex' => __('validation.password_regex'),
            'current_password' => __('validation.current_password'),
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'currentPass' => 'current password',
            'newPass' => 'new password',
            'confirmPassword' => 'confirm password',
        ];
    }

}
