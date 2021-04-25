<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->default(0);
            $table->bigInteger('module_id')->unsigned()->default(0);
            $table->enum('list',['0','1'])->default('0');
            $table->enum('check',['0','1'])->default('0');
            $table->enum('create',['0','1'])->default('0');
            $table->enum('edit',['0','1'])->default('0');
            $table->enum('delete',['0','1'])->default('0');
            $table->timestamps();

            $table->foreign('module_id')->references('id')->on('modules')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        DB::table('module_user')->insert(
            array(
                'module_id' => 1,
                'user_id' => 1,
                'list' => "1",
                'check' => "1",
                'create' => "1",
                'edit' => "1",
                'delete' => "1",
            )
        );
        DB::table('module_user')->insert(
            array(
                'module_id' => 3,
                'user_id' => 1,
                'list' => "1",
                'check' => "1",
                'create' => "1",
                'edit' => "1",
                'delete' => "1",
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
        Schema::dropIfExists('module_user');
    }
}
