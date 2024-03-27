<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('email')->nullable();
            $table->string('email_color')->nullable();
            $table->string('email_font_size')->nullable();
            $table->string('email_font_family')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('mobile_number_color')->nullable();
            $table->string('mobile_number_font_size')->nullable();
            $table->string('mobile_number_font_family')->nullable();
            $table->string('time')->nullable();
            $table->string('time_color')->nullable();
            $table->string('time_font_size')->nullable();
            $table->string('time_font_family')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->longText('address')->nullable();
            $table->string('address_color')->nullable();
            $table->string('address_font_size')->nullable();
            $table->string('address_font_family')->nullable();
            $table->string('email_icon')->nullable();
            $table->string('call_icon')->nullable();
            $table->string('address_icon')->nullable();
            $table->longText('footer_description')->nullable();
            $table->string('footer_description_color')->nullable();
            $table->string('footer_description_font_size')->nullable();
            $table->string('footer_description_font_family')->nullable();
            $table->softDeletes();
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
};
