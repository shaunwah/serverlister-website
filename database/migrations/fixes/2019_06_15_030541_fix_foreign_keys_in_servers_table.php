<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixForeignKeysInServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['country_id']);
            $table->dropForeign(['version_id']);
            $table->dropForeign(['type_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('version_id')->references('id')->on('versions');
            $table->foreign('type_id')->references('id')->on('server_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servers', function (Blueprint $table) {
            //
        });
    }
}
