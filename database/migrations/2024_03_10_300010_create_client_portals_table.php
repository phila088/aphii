<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('client_portals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('client_id')->constrained()->cascadeOnUpdate();
            $table->string('name', 50);
            $table->string('description', 500)->nullable();
            $table->string('url', 255);
            $table->string('username');
            $table->string('password');
            $table->boolean('general_portal')->default(false);
            $table->boolean('invoicing_only')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_portals');
    }
};
