<?php

namespace Modules\Newsletter\Rules;

use Illuminate\Contracts\Validation\Rule;
use Newsletter;

class UniqueMember implements Rule
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
        return !Newsletter::hasMember($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'این ایمیل قبلا در خبرنامه عضو شده است.';
    }
}
