<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_terms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name', 50);
            $table->string('code', 6);
            $table->string('description', 250)->default('');
            $table->tinyInteger('net_days')->default(0);
            $table->decimal('cod_amount')->default(0.00);
            $table->decimal('cod_percent')->default(0.00);
            $table->decimal('net_amount')->default(0.00);
            $table->decimal('net_percent')->default(0.00);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_terms');
    }
};
