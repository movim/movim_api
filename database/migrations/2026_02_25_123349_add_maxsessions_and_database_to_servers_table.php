<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('servers', function (Blueprint $table) {
            $table->string('database')->nullable();
            $table->integer('maxsessions')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('servers', function (Blueprint $table) {
            $table->dropColumn('database');
            $table->dropColumn('maxsessions');
        });
    }
};
