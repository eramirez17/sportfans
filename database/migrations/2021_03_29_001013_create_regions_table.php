<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('caption',50);
            $table->string('abstract',512)->nullable();
            $table->string('picture',256)->nullable();
            $table->string('slug',50);
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->string('external_link',512)->nullable();
            $table->timestamps();

            //relations
            $table->foreign('parent_id')->references('id')->on('regions')
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
        Schema::dropIfExists('regions');
    }
}
