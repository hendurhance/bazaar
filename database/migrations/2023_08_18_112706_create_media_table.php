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
        Schema::create('media', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignUuid('mediaable_id')->index()->nullable();
            $table->string('mediaable_type')->index()->nullable();
            $table->string('name')->nullable();
            $table->smallInteger('type')->nullable();
            $table->string('path')->nullable();
            $table->string('url')->nullable();
            $table->string('extension')->nullable();
            $table->bigInteger('size')->nullable();
            $table->string('mime_type')->nullable();
            $table->smallInteger('storage')->nullable(); // 1: local, 2: s3 bucket
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
