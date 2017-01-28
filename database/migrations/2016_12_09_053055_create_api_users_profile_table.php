<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiUsersProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_users_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description',512)->nullable();
            $table->string('display_name',200)->nullable();
            $table->string('username',200)->nullable();
            $table->string('email',200)->unique();
            $table->string('twitter_id',200)->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('facebook_id',200)->nullable();
            $table->string('facebook_url',200)->nullable();
            $table->string('twitter_url',200)->nullable();
            $table->string('city',100)->nullable();
            $table->string('country',200)->nullable();
            $table->string('address1',100)->nullable();
            $table->string('address2',100)->nullable();
            $table->string('phone',45)->nullable();
            $table->text('profile_picture_image')->nullable();
            $table->text('cover_picture_image')->nullable();
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')->on('api_users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('api_users_profile');
    }
}
