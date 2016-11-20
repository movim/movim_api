<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pods', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('url')->unique();
            $table->string('description');
            $table->integer('population')->required();
            $table->integer('connected')->required();
            $table->string('version');
            $table->string('php_version');
            $table->string('language');
            $table->string('ip')->unique();
            $table->string('geo_country');
            $table->string('geo_city');
            $table->string('jid');
            $table->boolean('activated');
            $table->boolean('favorite');
            $table->string('domain');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('pods');
    }
}
