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
        Schema::create('ads', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->nullable()->constrained('categories')->onDelete('cascade');

            $table->string('title');
            $table->string('slug')->unique()->index();
            $table->longText('description')->nullable();
            $table->smallInteger('type')->nullable();
            $table->unsignedDecimal('price', 12, 4)->nullable();
            $table->boolean('is_negotiable')->default(false);
            $table->string('video_url')->nullable();

            $table->string('seller_name')->nullable();
            $table->string('seller_email')->nullable();
            $table->string('seller_mobile', 15)->nullable();

            $table->boolean('mark_as_urgent')->default(false);
            $table->smallInteger('status')->default(1); // 1: pending for review, 2: published, 3: rejected, 4: expired
            $table->date('started_at')->nullable();
            $table->date('expired_at')->nullable();
            $table->unsignedBigInteger('views')->default(0);

            $table->json('media_ids')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
