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
        Schema::create('customer_galleries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('showroom_id')->unsigned(); 
            $table->foreign('showroom_id')->references('id')->on('showrooms');
            $table->string('customer_gallery_image')->nullable();
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
        Schema::dropIfExists('customer_galleries');
    }
};
