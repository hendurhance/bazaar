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
            $table->uuid()->primary();
            $table->string('name');
            $table->string('username', 191)->unique()->index();
            $table->string('email', 191)->unique();
            $table->string('mobile', 15)->unique()->nullable();
            $table->smallInteger('gender')->nullable();
            $table->string('avatar');
            $table->string('email_verification_token')->nullable()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(true);
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
