<?php

namespace App\Rules;
use Hash;
use Auth;
use Illuminate\Contracts\Validation\Rule;

class MatchOldPassword implements Rule
{
    public function __construct()
    {

    }

    //determine if the validation rule passes.
    public function passes($attribute, $value)
    {
        return Hash::check($value, auth()->user()->password);
    }

    //get validation error message
    public function message()
    {
        return 'Incorect password';
    }
}
