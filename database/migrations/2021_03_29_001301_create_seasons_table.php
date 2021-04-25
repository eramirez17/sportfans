<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->string('caption',50);
            $table->string('slug',50);
            $table->integer('quota')->unsigned();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status',['SET','STARTED','BREAK','ENDED'])->default('SET');
            $table->bigInteger('competition_id')->unsigned();
            $table->timestamps();

            //relations
            $table->foreign('competition_id')->references('id')->on('competitions')
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
        Schema::dropIfExists('seasons');
    }
}
