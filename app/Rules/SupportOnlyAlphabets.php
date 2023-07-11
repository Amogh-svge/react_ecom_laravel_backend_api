<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Str;

class SupportOnlyAlphabets implements InvokableRule
{
    /**
     * This rule checks if the given input is alphabet or not the difference between this rule and 
     * "alpha" is that alpha does not support spaces whereas this rule does 
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if ((Str::of($value)->matchAll('/^[\pL\s]+$/u')->isEmpty())) {
            $fail("The :attribute must only contain alphabets");
        }
    }
}
