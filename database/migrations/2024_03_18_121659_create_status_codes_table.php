<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('status_codes', function (Blueprint $table) {
            $table->id();
            $table->string('for_model', 50);
            $table->string('code');
            $table->string('title');
            $table->string('default_reason');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('status_codes');
    }
};
