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

            $table->integer('amount');
            $table->string('payment_method', 30);
            $table->string('payment_status', 30);
            $table->string('payment_code', 30);
            $table->text('remarks');
            $table->unique('payment_code');

            $table->foreignId('user_id')->nullable();
            $table->foreignId('plan_id')->nullable();

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
