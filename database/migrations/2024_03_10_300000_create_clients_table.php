<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate();
            $table->string('name', 50)->nullable();
            $table->string('dba', 50)->nullable();
            $table->string('abbreviation', 10)->nullable();
            $table->boolean('onboarding_started')->default(false);
            $table->date('onboarding_started_date')->nullable();
            $table->boolean('onboarding_finished')->default(false);
            $table->date('onboarding_finished_date')->nullable();
            $table->date('contract_start_date')->nullable();
            $table->date('contract_end_date')->nullable();
            $table->foreignId('payment_term_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->boolean('active')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
