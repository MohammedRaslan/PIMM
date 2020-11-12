<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class StatusType extends Enum
{
    const INFECTED = 1;
    const EXPOSED = 2;
    const FINE = 3;
 
}
