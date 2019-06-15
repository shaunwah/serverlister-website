<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerPingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_pings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('server_id');
            $table->boolean('status');
            $table->integer('rank')->nullable();
            $table->decimal('score', 11, 5)->nullable();
            $table->longText('favicon')->nullable();
            $table->text('description')->nullable();
            $table->string('protocol')->nullable();
            $table->integer('players_total')->nullable();
            $table->integer('players_current')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('server_pings');
    }
}
