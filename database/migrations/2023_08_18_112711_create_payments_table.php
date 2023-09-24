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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('payer_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('payee_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('ad_id')->constrained('ads')->onDelete('cascade');
            $table->foreignUuid('bid_id')->constrained('bids')->onDelete('cascade');
            $table->unsignedDecimal('amount', 12, 4)->nullable();
            $table->string('method')->nullable();
            $table->string('txn_id')->index()->nullable();
            $table->smallInteger('status')->default(1); // 'initial', 'pending', 'success', 'failed', 'declined', 'dispute'
            $table->string('currency')->nullable();
            $table->string('token')->nullable();
            $table->string('card_last4')->nullable();
            $table->string('card_id')->nullable();
            $table->string('client_ip')->nullable();
            $table->string('payer_email')->nullable();
            $table->smallInteger('gateway')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
