<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_participants', function (Blueprint $table) {
            $table->id()->index(); 
            $table->unsignedBigInteger('event_id')->index(); 
            $table->unsignedBigInteger('user_id')->index(); 
            $table->timestamps();
            $table->softDeletes(); 

            // Add foreign key for event_id
            $table->foreign('event_id', 'fk_event_participants_events')
                  ->references('id')
                  ->on('events')
                  ->onDelete('cascade');

            // Add foreign key for user_id
            $table->foreign('user_id', 'fk_event_participants_users')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_participants');
    }
};