<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NormalizePhoneNumber implements Rule
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
        return preg_match('/^0[0-9]{10}$/', $this->normalize($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'شماره موبایل نامعتبر است.';
    }

    /**
     * Normalize phone number to add leading zero if missing.
     *
     * @param  string  $phoneNumber
     * @return string
     */
    private function normalize($phoneNumber)
    {
        return ltrim($phoneNumber, '0') === $phoneNumber ? '0' . $phoneNumber : $phoneNumber;
    }
}
