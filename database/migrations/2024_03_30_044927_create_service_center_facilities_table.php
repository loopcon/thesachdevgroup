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
        Schema::create('service_center_facilities_and_customer_gallery', function (Blueprint $table) {
            $table->id();
            $table->integer('service_center_id')->nullable()->comment('`id` of `service_center`');
            $table->string('facility_image')->nullable();
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
        Schema::dropIfExists('service_center_facilities');
    }
};
