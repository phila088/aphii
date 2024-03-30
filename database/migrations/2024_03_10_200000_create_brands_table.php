<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('dba', 50)->nullable();
            $table->string('abbreviation', 10)->unique();
            $table->string('internal_work_order_prefix',10)->nullable();
            $table->integer('internal_work_order_max_length')->default(6)->nullable();
            $table->integer('internal_work_order_postfix_increment')->default(10)->nullable();
            $table->string('logo_path')->nullable();
            $table->string('fein')->nullable();
            $table->string('state_license_number')->nullable();
            $table->string('county_license_number')->nullable();
            $table->string('city_license_number')->nullable();
            $table->boolean('active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
