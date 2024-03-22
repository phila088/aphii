<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('brand_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('brand_id')->constrained()->cascadeOnUpdate();
            $table->string('title');
            $table->string('building_number')->nullable();
            $table->string('pre_direction')->nullable();
            $table->string('street_name')->nullable();
            $table->string('street_type')->nullable();
            $table->string('post_direction')->nullable();
            $table->string('unit_type')->nullable();
            $table->string('unit')->nullable();
            $table->string('po_box')->nullable();
            $table->foreignId('city_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('state_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->string('zip')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brand_addresses');
    }
};
