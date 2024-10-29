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
        Schema::create('wallets', function (Blueprint $table) {

            $table->id(); // unsignedBigInteger secara default
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('public_key', 64)->unique();
            $table->string('secret_key', 64)->unique();
            $table->decimal('balance', 20, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
