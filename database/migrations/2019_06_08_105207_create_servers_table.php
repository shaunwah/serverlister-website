<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('rank')->nullable();
            $table->decimal('score', 11, 5)->nullable();
            $table->string('host')->unique();
            $table->string('port')->default('25565');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('version_id');
            $table->unsignedBigInteger('type_id');
            $table->boolean('voting_service_enabled')->default(false);
            $table->string('voting_service_host')->nullable();
            $table->string('voting_service_port')->nullable()->default('8192');
            $table->binary('voting_service_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('servers');
    }
}
