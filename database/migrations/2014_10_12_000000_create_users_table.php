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
            $table->string('correo')->unique();
            $table->string('contrasenna');
            $table->string('nombre');
            $table->string('primerApellido');
            $table->string('segundoApellido');
            $table->timestamp('correo_verified_at')->nullable();
            $table->string('sexo');
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
            $table->dropForeign('users_rol_id_foreign');
            $table->dropColumn('role_id');
        });

        Schema::dropIfExists('users');
    }
}
