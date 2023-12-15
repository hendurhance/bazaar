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
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('payout_method_id')->constrained('payout_methods')->cascadeOnDelete();
            $table->foreignId('payment_id')->constrained('payments')->cascadeOnDelete();
            $table->unsignedDecimal('amount', 12, 4);
            $table->unsignedDecimal('fee', 12, 4);
            $table->string('currency')->nullable();
            $table->string('pyt_token')->nullable();
            $table->text('description')->nullable();
            $table->smallInteger('gateway')->nullable();
            $table->smallInteger('status')->default(0); // 'pending', 'success', 'failed'
            $table->dateTimeTz('paid_at')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
