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
            $table->string('google_id')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('name');
            $table->mediumText('imgURL')->nullable();
            $table->tinyInteger('dormitory')->nullable();
            $table->string('room',20)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('instagram')->nullable();
            $table->string('telegram')->nullable();
            $table->foreignId('role_id')->nullable()->constrained('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
