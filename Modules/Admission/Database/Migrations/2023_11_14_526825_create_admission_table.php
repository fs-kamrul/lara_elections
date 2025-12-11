<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionTable extends Migration
//return new class extends Migration
{
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();

            // add fields
            $table->string('uuid')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('photo')->nullable();
            $table->integer('nationality')->nullable();
            $table->string('birth_registration')->nullable();

            $table->string('roll')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_nane')->nullable();
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->integer('religion')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('class')->nullable();
            $table->integer('year')->nullable();
            $table->string('pre_institution')->nullable();
            $table->integer('pre_class')->nullable();
            $table->string('pre_gpa')->nullable();
            $table->string('pre_address')->nullable();
            $table->string('pre_postcode')->nullable();
            $table->integer('pre_country')->nullable();
            $table->integer('pre_states')->nullable();
            $table->integer('pre_city')->nullable();
            $table->string('per_address')->nullable();
            $table->string('per_postcode')->nullable();
            $table->integer('per_country')->nullable();
            $table->integer('per_states')->nullable();
            $table->integer('per_city')->nullable();
            $table->string('loc_name')->nullable();
            $table->string('loc_phone')->nullable();
            $table->string('loc_relation')->nullable();
            $table->string('loc_address')->nullable();
            $table->string('loc_postcode')->nullable();

            $table->integer('status')->default(1);
//            $table->bigInteger('user_id')->unsigned();
//            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('admissions');
    }
};
