<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('user_id')->index(); // Reference to users table
            $table->string('title');
            $table->text('content');
            $table->string('path')->nullable(); 
            $table->string('type')->index(); 
            $table->unsignedInteger('comments_count')->default(0)->nullable();
            $table->unsignedInteger('likes_count')->default(0)->nullable();
            $table->softDeletes(); 
            $table->timestamps();

            $table->foreign('user_id', 'fk_posts_user_id')
             ->references('id')
             ->on('users')
             ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
