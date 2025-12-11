<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPackageTable extends Migration
//return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('admin_packages')) {
            Schema::create('admin_packages', function (Blueprint $table) {
                $table->id();

                // add fields
                $table->string('uuid')->nullable();
                $table->string('name')->nullable();
                $table->string('name_limit')->nullable();
                $table->string('name_size')->nullable();
                $table->string('tag_line')->nullable();
                $table->string('slug')->nullable();
                $table->longText('description')->nullable();
                $table->Text('short_description')->nullable();
                $table->text('photo')->nullable();
                $table->integer('order')->default(0);
                $table->string('price')->nullable();
                $table->string('price_map')->nullable();
                $table->string('status')->nullable();
                $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');

                $table->timestamps();
            });
        }
        if (! Schema::hasTable('admin_packages_translations')) {
            Schema::create('admin_packages_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->integer('admin_packages_id');
                $table->string('name', 255)->nullable();
                $table->string('name_limit', 255)->nullable();
                $table->string('name_size', 255)->nullable();
                $table->string('tag_line', 255)->nullable();
                $table->string('designation')->nullable();
                $table->string('short_description', 400)->nullable();
                $table->longText('description')->nullable();
                $table->longText('price')->nullable();
                $table->longText('price_map')->nullable();
                $table->primary(['lang_code', 'admin_packages_id'], 'admin_packages_translations_primary');
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
        Schema::dropIfExists('admin_packages');
        Schema::dropIfExists('admin_packages_translations');
    }
};
