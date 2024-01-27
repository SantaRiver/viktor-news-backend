<?php

namespace App\Enums;

use App\Traits\EnumCasesArray;

enum NewsStatus
{
    use EnumCasesArray;

    case Draft;
    case Published;
    case Hidden;
}
