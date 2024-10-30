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
        Schema::create('book_consult', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->date('date');
            $table->time('time');
            $table->text('query');
            $table->timestamps();
            $table->softDeletes();

            // Define foreign key constraint for user_id
            $table->foreign('user_id', 'fk_user_id')
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
        Schema::table('book_consult', function (Blueprint $table) {
            // Drop the foreign key and indexes before dropping the table
            $table->dropForeign('fk_user_id');
            $table->dropIndex(['id']);
            $table->dropIndex(['user_id']);
        });

        Schema::dropIfExists('book_consult');
    }
};