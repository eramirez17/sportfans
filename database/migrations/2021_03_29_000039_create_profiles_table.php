<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('caption',50);
            $table->string('abstract',512)->nullable;
            $table->timestamps();
        });
        DB::table('profiles')->insert(
            array(
                'caption' => 'SA',
                'abstract' => 'Super Administrador del Sistema',
            )
        );
        DB::table('profiles')->insert(
            array(
                'caption' => 'Invitado',
                'abstract' => 'Este perfil no tiene asignada ninguna acción en el sistema',
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
        Schema::dropIfExists('profiles');
    }
}
