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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('iso2', 2)->index();
            $table->string('iso3', 3)->index();
            $table->string('name', 191)->index();
            $table->string('phone_code', 191)->nullable();
            $table->string('capital', 191)->nullable();
            $table->string('currency', 191)->nullable();
            $table->string('currency_symbol', 191)->nullable();
            $table->string('currency_code', 191)->nullable();
            $table->string('emoji', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
