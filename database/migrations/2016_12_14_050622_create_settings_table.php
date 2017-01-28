<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
          $table->increments('id');
          $table->string('meta_title')->nullable();
          $table->text('meta_keywords', 65535)->nullable();
          $table->text('meta_descriptions', 65535)->nullable();
          $table->string('phone1')->nullable();
          $table->string('phone2')->nullable();
          $table->string('mobile_no')->nullable();
          $table->string('email')->nullable();
          $table->string('public_email')->nullable();
          $table->string('latitude')->nullable();
          $table->string('longitude')->nullable();
          $table->string('fb_link')->nullable();
          $table->string('twitter_link')->nullable();
          $table->string('youtube_link')->nullable();
          $table->string('skype_link')->nullable();
          $table->string('instagram_link')->nullable();
          $table->string('main_title')->nullable();
          $table->string('secondary_title')->nullable();
          $table->string('time_zone')->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
