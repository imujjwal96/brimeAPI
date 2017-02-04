<?php

namespace Brime\Validation\Rules;

use Brime\Models\User;
use Respect\Validation\Rules\AbstractRule;

class EmailAvailable extends AbstractRule
{

    public function validate($input)
    {
        return User::where('email', $input)->count() == 0;
    }
}