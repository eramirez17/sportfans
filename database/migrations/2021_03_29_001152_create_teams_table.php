<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('caption',50);
            $table->string('logo',256)->nullable();
            
            $table->bigInteger('stadium_id')->unsigned();
            $table->bigInteger('sport_id')->unsigned();
            $table->bigInteger('region_id')->unsigned();
            $table->enum('type',['club','nation'])->default('club');
            $table->string('slug',50);
            $table->timestamps();

            //relations
            $table->foreign('stadium_id')->references('id')->on('stadiums')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('sport_id')->references('id')->on('sports')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('region_id')->references('id')->on('regions')
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
        Schema::dropIfExists('teams');
    }
}
