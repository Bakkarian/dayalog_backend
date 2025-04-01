<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidSystemToken implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //system_id and system_access_token should be valid
        
       if(config("system.".request()->system_id.'.token') != trim($value)){
           $fail('The system token is invalid.');
       }
    }
}
