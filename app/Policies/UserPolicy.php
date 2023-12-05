<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

final class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, User $model): bool
    {
        return $user->getKey() === $model->getKey();
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, User $model): bool
    {
        return $user->getKey() === $model->getKey();
    }

    public function delete(User $user, User $model): bool
    {
        return $user->getKey() === $model->getKey();
    }

    public function restore(User $user, User $model): bool
    {
        return $user->getKey() === $model->getKey();
    }

    public function forceDelete(User $user, User $model): bool
    {
        return $user->getKey() === $model->getKey();
    }
}
