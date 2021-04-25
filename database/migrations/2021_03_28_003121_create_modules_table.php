<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('caption',50)->unique();
            $table->timestamps();
        });
        DB::table('modules')->insert(
            array(
                'caption' => 'modules',
            )
        );
        DB::table('modules')->insert(
            array(
                'caption' => 'profiles',
            )
        );
        DB::table('modules')->insert(
            array(
                'caption' => 'users',
            )
        );
        DB::table('modules')->insert(
            array(
                'caption' => 'options',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
