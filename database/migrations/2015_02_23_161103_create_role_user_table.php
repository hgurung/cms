<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->integer('role_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('role_user');
    }
}
