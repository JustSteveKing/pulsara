<?php

declare(strict_types=1);

namespace App\Enums\Identity;

enum Role: string
{
    case User = 'user';
    case Moderator = 'moderator';
    case Admin = 'admin';
}
