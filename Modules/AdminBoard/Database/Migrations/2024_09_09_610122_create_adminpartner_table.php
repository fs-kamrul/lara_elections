<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPartnerTable extends Migration
//return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('admin_partners')) {
            Schema::create('admin_partners', function (Blueprint $table) {
                $table->id();

                // add fields
                $table->string('uuid')->nullable();
                $table->string('name')->nullable();
                $table->string('tag_line')->nullable();
                $table->string('slug')->nullable();
                $table->string('coupon_code')->nullable();
                $table->longText('description')->nullable();
                $table->Text('short_description')->nullable();
                $table->text('photo')->nullable();
                $table->string('set_url')->nullable();
                $table->integer('order')->default(0);
                $table->string('status')->nullable();
                $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');

                $table->timestamps();
            });
        }
        if (! Schema::hasTable('admin_partners_translations')) {
            Schema::create('admin_partners_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->integer('admin_partners_id');
                $table->string('name', 255)->nullable();
                $table->string('tag_line')->nullable();
                $table->string('short_description', 400)->nullable();
                $table->longText('description')->nullable();
                $table->primary(['lang_code', 'admin_partners_id'], 'admin_partners_translations_primary');
            });
        }
        if (! Schema::hasTable('admin_partner_categories')) {
            Schema::create('admin_partner_categories', function (Blueprint $table) {
                $table->id();
                $table->integer('partner_id')->unsigned()->references('id')->on('admin_partners')->onDelete('cascade');
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
        Schema::dropIfExists('admin_partners');
        Schema::dropIfExists('admin_partners_translations');
        Schema::dropIfExists('admin_partner_categories');
    }
};
