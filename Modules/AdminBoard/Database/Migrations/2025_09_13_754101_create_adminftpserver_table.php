<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminFtpServerTable extends Migration
//return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('admin_ftp_servers')) {
            Schema::create('admin_ftp_servers', function (Blueprint $table) {
                $table->id();

                // add fields
                $table->string('uuid')->nullable();
                $table->string('name')->nullable();
                $table->string('slug')->nullable();
                $table->longText('description')->nullable();
                $table->Text('short_description')->nullable();
                $table->Text('url_name')->nullable();
                $table->text('photo')->nullable();
                $table->integer('order')->default(0);
                $table->string('status')->nullable();
                $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');

                $table->timestamps();
            });
        }
        if (! Schema::hasTable('admin_ftp_servers_translations')) {
            Schema::create('admin_ftp_servers_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->integer('admin_ftp_servers_id');
                $table->string('name', 255)->nullable();
                $table->longText('description')->nullable();
                $table->primary(['lang_code', 'admin_ftp_servers_id'], 'admin_ftp_servers_translations_primary');
            });
        }
        if (! Schema::hasTable('admin_ftp_server_categories')) {
            Schema::create('admin_ftp_server_categories', function (Blueprint $table) {
                $table->id();
                $table->integer('ftp_server_id')->unsigned()->references('id')->on('admin_ftp_servers')->onDelete('cascade');
                $table->integer('category_id')->unsigned()->references('id')->on('admin_categories')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_ftp_servers');
        Schema::dropIfExists('admin_ftp_servers_translations');
        Schema::dropIfExists('admin_ftp_server_categories');
    }
};
