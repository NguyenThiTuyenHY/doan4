<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use recaptcha/recaptcha;

class captcha implements Rule
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
        $recaptcha = new recaptcha(env('CAPTCHA_SECRET'));
        $response = $recaptcha->verify($value,$_SERVER['REMOTE_ADDR']);
        return $response->isSuccess();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Xác nhận recaptcha trước khi ấn';
    }
}
