<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_terms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate();
            $table->string('code', 10)->unique();
            $table->string('title', 50);
            $table->integer('net_days');
            $table->decimal('amount_cod');
            $table->decimal('percent_cod', 8, 4);
            $table->decimal('amount_net');
            $table->decimal('percent_net', 8, 4);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_terms');
    }
};
