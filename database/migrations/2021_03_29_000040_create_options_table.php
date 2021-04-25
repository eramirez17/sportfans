<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->string('caption',200);
            $table->string('abstract',512);
            $table->enum('target',['_blank','_self','_parent','_top'])->default('_self');
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->enum('level',['root','node','child'])->default('root');
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('options')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        DB::table('options')->insert(
            array(
                'link' => '',
                'caption' => 'Seguridad',
                'abstract' => 'Administracion de seguridad del sistema',
                'target' => '_self',
                'level' => 'root',
            )
        );
        DB::table('options')->insert(
            array(
                'link' => 'users.index',
                'caption' => 'Usuarios',
                'abstract' => 'Listar, ver, crear, modificar y eliminar Usuarios',
                'target' => '_self',
                'parent_id' => 1,
                'level' => 'node',
            )
        );
        DB::table('options')->insert(
            array(
                'link' => 'profiles.index',
                'caption' => 'Perfiles',
                'abstract' => 'Listar, ver, crear, modificar y eliminar Perfiles',
                'target' => '_self',
                'parent_id' => 1,
                'level' => 'node',
            )
        );
        DB::table('options')->insert(
            array(
                'link' => 'options.index',
                'caption' => 'Opc del Sistema',
                'abstract' => 'Listar, ver, crear, modificar y eliminar Opciones del Sistema',
                'target' => '_self',
                'parent_id' => 1,
                'level' => 'node',
            )
        );
        DB::table('options')->insert(
            array(
                'link' => 'modules.index',
                'caption' => 'Módulos',
                'abstract' => 'Listar, ver, crear, modificar y eliminar permisos de módulos',
                'target' => '_self',
                'parent_id' => 1,
                'level' => 'node',
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
        Schema::dropIfExists('options');
    }
}
