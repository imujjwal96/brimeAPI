<?php

namespace Brime\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'username',
        'email',
        'password',
        'firstName',
        'lastName',
        'birthDate',
        'verified'
    ];
}