<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('title')->nullable();
            $table->string('post_image')->nullable();
            $table->text('good_things');
            $table->text('actions_for_value');
            $table->integer('score');
            $table->text('troubles')->nullable();
            $table->text('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
}