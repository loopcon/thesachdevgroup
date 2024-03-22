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
        Schema::create('showrooms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('brand_id')->unsigned(); 
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->string('car_id')->nullable();
            $table->longText('address')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('address_color')->nullable();
            $table->string('address_font_size')->nullable();
            $table->string('address_font_family')->nullable();
            $table->string('working_hours_color')->nullable();
            $table->string('working_hours_font_size')->nullable();
            $table->string('working_hours_font_family')->nullable();
            $table->string('contact_number_color')->nullable();
            $table->string('contact_number_font_size')->nullable();
            $table->string('contact_number_font_family')->nullable();
            $table->string('email_color')->nullable();
            $table->string('email_font_size')->nullable();
            $table->string('email_font_family')->nullable();
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
        Schema::dropIfExists('showrooms');
    }
};
