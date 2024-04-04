<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('brand_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->foreignId('client_id')->constrained('clients');
            $table->unique(['brand_id', 'client_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brand_clients');
    }
};
