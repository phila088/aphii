<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate();
            $table->foreignId('payment_term_id')->constrained('payment_terms')->cascadeOnUpdate();
            $table->string('name');
            $table->string('dba');
            $table->boolean('saturday_hours')->default(false);
            $table->boolean('sunday_hours')->default(false);
            $table->boolean('holiday_hours')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
