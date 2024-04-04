<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vendor_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('vendors')->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('department')->nullable();
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_work')->nullable();
            $table->string('phone_work_extension')->nullable();
            $table->string('phone_mobile')->nullable();
            $table->string('phone_personal')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_contacts');
    }
};
