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
        Schema::create('home_our_businesses_titles', function (Blueprint $table) {
            $table->id();
            $table->string('businesses_title')->nullable();
            $table->string('businesses_title_color')->nullable();
            $table->string('businesses_title_font_size')->nullable();
            $table->string('businesses_title_font_family')->nullable();
            $table->string('background_color')->nullable();
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
        Schema::dropIfExists('home_our_businesses_titles');
    }
};
