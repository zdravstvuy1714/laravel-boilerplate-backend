<?php

declare(strict_types=1);

namespace App\Enum;

enum EnvironmentEnum: string
{
    case Production = 'production';
    case Local = 'local';
    case Testing = 'testing';
}
