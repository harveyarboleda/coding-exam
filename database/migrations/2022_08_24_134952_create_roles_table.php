<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('roles_name');
            $table->string('roles_description');
        });

        DB::table('roles')->insert(
            array(
                [
                    "roles_name" => 'Administrator',
                    "roles_description" => 'Hello world 1!'
                ],
                [
                    "roles_name" => 'Operator',
                    "roles_description" => 'Hello world 2!'
                ],
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
        Schema::dropIfExists('roles');
    }
}
