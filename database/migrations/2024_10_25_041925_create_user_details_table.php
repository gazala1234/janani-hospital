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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id()->index(); 
            $table->string('fname'); 
            $table->string('lname'); 
            $table->string('city'); 
            $table->unsignedBigInteger('user_id');
            $table->string('email')->unique()->nullable();
            $table->string('country')->nullable(); 
            $table->date('dob'); 
            $table->unsignedBigInteger('mobile')->unique()->index(); 
            $table->string('blood_group'); 
            $table->text('address')->nullable(); 
            $table->string('img_path')->nullable(); 
            $table->softDeletes(); 
            $table->timestamps();

            $table->foreign('user_id', 'fk_users_user_id')
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
        Schema::dropIfExists('user_details');
    }
};