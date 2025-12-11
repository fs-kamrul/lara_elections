<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectionTable extends Migration
//return new class extends Migration
{
    public function up()
    {
        Schema::create('elections', function (Blueprint $table) {
            $table->id();

            // add fields
            $table->string('uuid')->nullable();
            $table->string('name')->nullable();    //   e.g. "13th National Parliament Election"
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->text('photo')->nullable();
            $table->date('election_date')->nullable();
            $table->string('order')->nullable();
            $table->string('type')->nullable();
            $table->longText('notes')->nullable(); //parliamentary/city_corp/upazila/union
            $table->string('status')->default('active');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('elections');
    }
};
