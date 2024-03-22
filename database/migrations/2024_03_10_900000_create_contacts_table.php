<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('client_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('vendor_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('contact_position_id')->constrained()->cascadeOnUpdate();
            $table->string('first_name', 25)->nullable();
            $table->string('last_name', 25)->nullable();
            $table->string('phone_work', 15)->nullable();
            $table->string('phone_work_extension', 15)->nullable();
            $table->string('phone_mobile', 15)->nullable();
            $table->string('email', 15)->nullable();
            $table->string('pre_direction', 10)->nullable();
            $table->string('building_number')->nullable();
            $table->string('street_name', 255)->nullable();
            $table->string('street_type');
            $table->string('post_direction', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 25)->nullable();
            $table->string('zip', 25)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
