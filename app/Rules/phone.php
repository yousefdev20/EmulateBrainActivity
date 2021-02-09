<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class phone implements Rule
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
        return substr($value,0,3) == '079'||substr($value,0,3) == '078'||substr($value,0,3) == '077';


    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Phone Number Shall Start With 079 | 078 | 077.';
    }
}
