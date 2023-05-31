<?php

namespace App\Http\Requests;

use App\Rules\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Gate::denies('isAdmin') && Gate::denies('isDM')) {
            return Auth::id() == $this->id;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $isEmpty = empty($this->id);
        return [
            'email' => "required|email|max:50|unique:App\Models\User,email, $this->id",
            'password' => $isEmpty ? [
                'required',
                'min:8',
                'max:25',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#])(?=.*[0-9])(?=[^\s])/',
            ] : ['nullable'],
            'fullname' => 'required|max:50',
            'code' => "required|integer|unique:App\Models\User,code,$this->id",
            'area_code' => 'required|max:6',
            'phone_number' => "required|numeric|min:9|unique:App\Models\User,phone_number, $this->id",
            'day_of_birth' => 'required|before:today',
            'address' => 'required|max:100',
            'roles' => [
                'required',
                $isEmpty ? new Role : Rule::in(['Other','Admin', 'DM', 'Sub-DM', 'TL', 'PM', 'Members']),
            ],
            'levels' => [
                'required',
                Rule::in(['Other', 'Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5']),
            ],
            'status' => [
                'required',
                Rule::in(['Inactive', 'Active', 'Left']),
            ],
            'types' => [
                'required',
                Rule::in(['Other', 'Official', 'Probationary', 'Apprenticeship', 'Fresher', 'Intern', 'Onsite']),
            ],
            'note' => 'max:255',
            'department_id' => 'required',
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
            'email' => __('validation.email'),
            'max' => __('validation.max'),
            'unique' => __('validation.unique'),
            'min' => __('validation.min'),
            'password.regex' => __('validation.password_regex'),
            'day_of_birth.before' => __('validation.before_today'),
            'roles.required' => __('validation.selected_required'),
            'levels.required' => __('validation.selected_required'),
            'status.required' => __('validation.selected_required'),
            'types.required' => __('validation.selected_required'),
            'department_id.required' => __('validation.selected_required'),
        ];
    }
}
