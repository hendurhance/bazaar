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
            $table->string('seller_address')->nullable();

            $table->boolean('mark_as_urgent')->default(false);
            $table->smallInteger('status')->default(1); // 1: pending for review, 2: published, 3: rejected, 4: expired
            $table->dateTimeTz('started_at')->nullable();
            $table->dateTimeTz('expired_at')->nullable();
            $table->unsignedBigInteger('views')->default(0);

            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('cascade');
            $table->foreignId('state_id')->nullable()->constrained('states')->onDelete('cascade');
            $table->string('city_id')->nullable()->constrained('cities')->onDelete('cascade');

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
