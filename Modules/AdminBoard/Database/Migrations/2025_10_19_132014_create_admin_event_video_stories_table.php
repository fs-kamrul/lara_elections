<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminEventVideoStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('admin_event_video_stories');
        Schema::create('admin_event_video_stories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_event_id')->constrained('admin_events')->cascadeOnDelete();
            $table->string('youtube_url')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->text('text_story')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_designation')->nullable();
            $table->string('user_image')->nullable();
            $table->timestamps();
        });
        Schema::dropIfExists('admin_event_video_stories_translations');
        Schema::create('admin_event_video_stories_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->integer('admin_event_video_stories_id');
            $table->string('text_story')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_designation')->nullable();

            $table->primary(['lang_code', 'admin_event_video_stories_id'], 'admin_event_video_stories_translations_primary');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_event_video_stories');
        Schema::dropIfExists('admin_event_video_stories_translations');
    }
}
