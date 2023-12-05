<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Publishing\Status;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->realText(
                maxNbChars: 160,
            ),
            'avatar' => $this->faker->imageUrl(),
            'cover' => $this->faker->imageUrl(
                width: 1290,
                height: 680,
            ),
            'status' => Status::Public,
            'members' => 0,
            'tags' => [],
            'user_id' => User::factory()
        ];
    }
}
