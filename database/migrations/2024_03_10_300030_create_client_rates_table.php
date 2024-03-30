<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('client_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('client_id')->constrained()->cascadeOnUpdate();
            $table->string('title', 50)->default('Standard');
            $table->boolean('default')->default(false);
            $table->decimal('standard_assessment')->default(0);
            $table->decimal('emergency_assessment')->default(0);
            $table->decimal('overtime_assessment')->default(0);
            $table->decimal('saturday_assessment')->default(0);
            $table->decimal('sunday_assessment')->default(0);
            $table->decimal('holiday_assessment')->default(0);
            $table->decimal('standard_trip')->default(0);
            $table->decimal('standard_hour')->default(0);
            $table->decimal('emergency_trip')->default(0);
            $table->decimal('emergency_hour')->default(0);
            $table->decimal('overtime_trip')->default(0);
            $table->decimal('overtime_hour')->default(0);
            $table->decimal('saturday_trip')->default(0);
            $table->decimal('saturday_hour')->default(0);
            $table->decimal('sunday_trip')->default(0);
            $table->decimal('sunday_hour')->default(0);
            $table->decimal('holiday_trip')->default(0);
            $table->decimal('holiday_hour')->default(0);
            $table->string('custom_field_1_description', 50)->default(0);
            $table->decimal('custom_field_1_amount')->default(0);
            $table->string('custom_field_2_description', 50)->default(0);
            $table->decimal('custom_field_2_amount')->default(0);
            $table->string('custom_field_3_description', 50)->default(0);
            $table->decimal('custom_field_3_amount')->default(0);
            $table->string('custom_field_4_description', 50)->default(0);
            $table->decimal('custom_field_4_amount')->default(0);
            $table->string('custom_field_5_description', 50)->default(0);
            $table->decimal('custom_field_5_amount')->default(0);
            $table->string('custom_field_6_description', 50)->default(0);
            $table->decimal('custom_field_6_amount')->default(0);
            $table->string('custom_field_7_description', 50)->default(0);
            $table->decimal('custom_field_7_amount')->default(0);
            $table->string('custom_field_8_description', 50)->default(0);
            $table->decimal('custom_field_8_amount')->default(0);
            $table->string('custom_field_9_description', 50)->default(0);
            $table->decimal('custom_field_9_amount')->default(0);
            $table->string('custom_field_10_description', 50)->default(0);
            $table->decimal('custom_field_10_amount')->default(0);
            $table->boolean('active')->default(false);
            $table->date('start_date')->default(now());
            $table->date('end_date')->default(now()->add('1 year'));
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_rates');
    }
};
