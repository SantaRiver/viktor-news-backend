<?php

namespace App\Traits;

trait EnumCasesArray
{
    public static function casesArray(): array
    {
        return array_map(function ($case) {
            return $case->name;
        }, self::cases());
    }
}
