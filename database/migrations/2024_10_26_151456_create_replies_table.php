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
        Schema::create('replies', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('user_id')->index(); 
            $table->unsignedBigInteger('comment_id')->index();
            $table->text('content');
            $table->string('path')->nullable(); 
            $table->unsignedInteger('replies_count')->default(0)->index();
            $table->unsignedInteger('likes_count')->default(0)->index();
            $table->softDeletes(); 
            $table->timestamps();

            $table->foreign('user_id', 'fk_replies_user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');


            $table->foreign('comment_id', 'fk_comments_comment_id')
            ->references('id')
            ->on('comments')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
