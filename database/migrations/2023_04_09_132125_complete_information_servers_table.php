<?php

use App\Server;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('servers', function (Blueprint $table) {
            $table->integer('population')->default(0);
            $table->integer('connected')->default(0);
            $table->string('banner')->nullable();
            $table->string('version')->nullable();
            $table->dropColumn('title');
            $table->dropColumn('url');
            $table->dropColumn('geo_country');
            $table->dropColumn('geo_city');
        });

        Schema::create('server_admins', function (Blueprint $table) {
            $table->id();
            $table->string('jid');
            $table->integer('server_id')->unsigned();
            $table->foreign('server_id')
                ->references('id')->on('servers')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('server_whitelists', function (Blueprint $table) {
            $table->id();
            $table->string('xmpp_domain');
            $table->integer('server_id')->unsigned();
            $table->foreign('server_id')
                ->references('id')->on('servers')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servers', function (Blueprint $table) {
            $table->dropColumn('population');
            $table->dropColumn('connected');
            $table->dropColumn('banner');
            $table->dropColumn('version');
            $table->string('url')->required()->default('https://domain.tld/');
            $table->string('title')->required()->default('Title');
            $table->string('geo_country')->nullable();
            $table->string('geo_city')->nullable();
        });

        Schema::drop('server_admins');
        Schema::drop('server_whitelists');
    }
};
