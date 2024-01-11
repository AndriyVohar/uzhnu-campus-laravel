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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('google_id');
            $table->string('email')->unique();
            $table->string('name');
            $table->mediumText('imgURL');
            $table->tinyInteger('dormitory')->nullable();
            $table->string('room',20)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('instagram')->nullable();
            $table->string('telegram')->nullable();
            $table->string('role')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
