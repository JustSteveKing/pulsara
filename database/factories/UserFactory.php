<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Identity\Provider;
use App\Enums\Identity\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role' => Role::User,
            'provider' => Provider::Email,
            'provider_id' => null,
            'avatar' => $this->faker->imageUrl(),
            'access_token' => null,
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ];
    }
}
