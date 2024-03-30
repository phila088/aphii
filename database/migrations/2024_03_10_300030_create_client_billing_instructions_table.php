<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('client_billing_instructions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('client_id')->constrained()->cascadeOnUpdate();
            $table->text('instructions')->nullable();
            $table->json('sub_instructions')->nullable();
            $table->integer('order')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_billing_instructions');
    }
};
