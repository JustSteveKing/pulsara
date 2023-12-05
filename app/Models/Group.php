<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Publishing\Status;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $description
 * @property null|string $avatar
 * @property null|string $cover
 * @property Status $status
 * @property int $members
 * @property null|AsCollection $tags
 * @property string $user_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property User $user
 * @property Collection<Post> $posts
 */
final class Group extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'description',
        'avatar',
        'cover',
        'status',
        'members',
        'tags',
        'user_id',
    ];

    protected $casts = [
        'status' => Status::class,
        'members' => 'integer',
        'tags' => AsCollection::class,
    ];

    /**
     * Administrative User
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    public function posts(): HasMany
    {
        return $this->hasMany(
            related: Post::class,
            foreignKey: 'group_id',
        );
    }
}
