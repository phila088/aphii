<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_client')->default(false);
            $table->boolean('is_employee')->default(false);
            $table->boolean('is_vendor')->default(false);
            $table->boolean('active')->default(true);
            $table->boolean('locked')->default(false);
            $table->string('profile_picture_path')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_mobile')->nullable();
            $table->string('phone_work')->nullable();
            $table->string('phone_work_extension')->nullable();
            $table->string('sex')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('timezone')->nullable();
            $table->timestampTz('last_activity')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
