<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_team', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('season_id')->unsigned();
            $table->bigInteger('team_id')->unsigned();
            $table->integer('position')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('season_id')->references('id')->on('seasons')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                $table->foreign('team_id')->references('id')->on('teams')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season_team');
    }
}
