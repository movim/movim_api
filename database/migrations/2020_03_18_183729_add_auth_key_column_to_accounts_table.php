<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthKeyColumnToAccountsTable extends Migration
{
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->string('auth_key')->nullable()->unique();
            $table->string('domain')->default('movim.eu');
            $table->boolean('email_notification')->default(false);
            $table->string('ip')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('auth_key');
            $table->dropColumn('domain');
            $table->dropColumn('email_notification');
            $table->string('ip')->nullable(false)->change(); // Null IPs ?
        });
    }
}
