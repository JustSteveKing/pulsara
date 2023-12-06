<?php

declare(strict_types=1);

namespace App\Models\Builders;

use App\Enums\Publishing\Stage;
use Illuminate\Database\Eloquent\Builder;

final class PostBuilder extends Builder
{
    public function approved(): PostBuilder
    {
        return $this->where(
            'stage',
            Stage::Approved
        );
    }
}
