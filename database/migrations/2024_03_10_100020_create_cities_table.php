<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('county_id')->constrained()->cascadeOnUpdate();
            $table->string('name', 50);
            $table->char('zip', 10);
            $table->decimal('latitude', 12,8);
            $table->decimal('longitude', 12, 8);
            $table->string('timezone', 100);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
