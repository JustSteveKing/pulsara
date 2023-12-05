<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'handle' => $this->faker->unique()->userName(),
            'cover' => $this->faker->imageUrl(
                width: 1290,
                height: 680,
            ),
            'country' => $this->faker->countryCode(),
            'user_id' => User::factory(),
        ];
    }
}
