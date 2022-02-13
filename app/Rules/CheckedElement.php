<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckedElement implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $isChecked = false;
        foreach ($value as $val) {
            if($val !== false){
                return true;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Selecciona al menos un día';
        // return 'The :attribute must be selected at least one.';
    }
}