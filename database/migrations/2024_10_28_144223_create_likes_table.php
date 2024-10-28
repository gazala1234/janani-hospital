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
        Schema::create('likes', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('user_id')->index(); 
            $table->unsignedBigInteger('post_id')->index(); 
            $table->softDeletes(); 
            $table->timestamps();

            $table->foreign('user_id', 'fk_likes_user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');


            $table->foreign('post_id', 'fk_likes_post_id')
            ->references('id')
            ->on('posts')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
