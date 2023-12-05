<?php

declare(strict_types=1);

namespace App\Enums\Publishing;

enum Status: string
{
    case Public = 'public'; // anyone can join
    case Private = 'private'; // invite only
    case Verified = 'verified'; // official groups
}
