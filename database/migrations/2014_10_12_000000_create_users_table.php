<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('PrimerApellido');
            $table->string('SegundoApellido');
            $table->string('correo')->unique();
            $table->timestamp('correo_verified_at')->nullable();
            $table->string('Sexo');
            $table->unsignedInteger('rol_id');
            $table->rememberToken();
            $table->timestamps();
            //Asocia con el rol
            $table->foreign('rol_id')->references('id')->on('roles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_id_foreign');
            $table->dropColumn('role_id');
        });

        Schema::dropIfExists('users');
    }
}
