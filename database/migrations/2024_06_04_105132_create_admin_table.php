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
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('mobile');
            $table->string('email');
            $table->string('college');
            $table->string('cid');
            $table->string('dept');
            $table->string('did');
            $table->string('role');
            $table->string('punch_id');
            $table->string('designation');
            $table->string('designation_id');
            $table->string('doj');
            $table->string('ptype');
            $table->string('status');
            $table->string('gender');
            $table->string('dob');
            $table->string('doc');
            $table->string('pass');
            $table->string('prt');
            $table->string('sl');
            $table->string('nbarole');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
