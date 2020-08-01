<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoHtml implements Rule
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
    public function passes($attribute, $value){
        return strip_tags($value) === $value;
    }
 
    public function message(){
        return 'HTML tags are not allowed.';
    }
}
