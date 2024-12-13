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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_wallet_id')->constrained('wallets');
            $table->foreignId('recipient_wallet_id')->constrained('wallets');
            $table->decimal('amount', 20, 8);
            $table->string('currency_type');
            $table->enum('type', [
                'transfer', 
                'deposit', 
                'withdrawal', 
                'exchange', 
                'fee'
            ]);
            $table->enum('status', [
                'pending', 
                'completed', 
                'failed', 
                'canceled', 
                'processing'
            ])->default('pending');
            $table->text('description')->nullable();
            $table->string('transaction_hash')->unique()->nullable();
            $table->decimal('fee', 10, 4)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
