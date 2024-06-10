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
        Schema::create('assignment', function (Blueprint $table) {
            $table->id();
            $table->integer('eid');
            $table->integer('cid');
            $table->integer('did');
            $table->string('acd_year');
            $table->string('name');
            $table->string('task');
            $table->string('description');
            $table->dateTime('from')->comment('deadline');
            $table->dateTime('to')->comment('deadline');
            $table->string('file');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment');
    }
};
