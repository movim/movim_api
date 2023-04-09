<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('add_server_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->boolean('used')->default(false);
            $table->string('domain');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('add_server_tokens');
    }
};
