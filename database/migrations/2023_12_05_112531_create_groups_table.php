<?php

declare(strict_types=1);

use App\Enums\Publishing\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('groups', static function (Blueprint $table): void {
            $table->ulid('id')->primary();

            $table->string('name');
            $table->string('description', 160);
            $table->string('avatar')->nullable();
            $table->string('cover')->nullable();
            $table->string('status')->default(Status::Public->value);

            $table->unsignedBigInteger('members')->default(0);

            $table->json('tags')->nullable();

            $table
                ->foreignUlid('user_id')
                ->comment('Admin User ID')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
