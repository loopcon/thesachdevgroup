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
        Schema::table('home_details', function (Blueprint $table) {
            $table->string('our_story_image')->nullable()->after('description');
            $table->string('our_story_title')->nullable()->after('our_story_image');
            $table->longText('our_story_description')->nullable()->after('our_story_title');
            $table->string('our_mission_title')->nullable()->after('our_story_description');
            $table->longText('our_mission_description')->nullable()->after('our_mission_title');
            $table->string('our_vision_title')->nullable()->after('our_mission_description');
            $table->longText('our_vision_description')->nullable()->after('our_vision_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_details', function (Blueprint $table) {
            //
        });
    }
};
