<?php

declare(strict_types=1);

namespace App\Models\Builders;

use App\Enums\Publishing\Status;
use Illuminate\Database\Eloquent\Builder;

final class GroupBuilder extends Builder
{
    public function verified(): GroupBuilder
    {
        return $this->where(
            'status',
            Status::Verified,
        );
    }
}
