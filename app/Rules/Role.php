<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Gate;

class Role implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(Gate::allows('isAdmin')) {
            if(!array_search($value, ['Other', 'DM', 'Sub-DM', 'TL', 'PM', 'Members'])) {
                $fail(__('validation.roles_invalid'));
            }
        } else if(!array_search($value, ['Other', 'Sub-DM', 'TL', 'PM', 'Members'])) {
            $fail(__('validation.roles_invalid'));
        }
    }
}
