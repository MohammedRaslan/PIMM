<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class UserType extends Enum
{
    const PERSONAL = 1;
    const ORGANIZATION = 2;
    const ADMIN = 3;
}
