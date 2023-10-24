<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function(Blueprint $table){

            $table->id();
            $table->string('Name');
            $table->string('Last');
            $table->string('Las2');
            $table->char('Gender');
            $table->string('CURP');
            $table->string('MaritalStatusID');
            $table->date('BirthDate');
            $table->string('BirthCity');
            $table->integer('BirthPlaceID');
            $table->integer('ReligionID');
            $table->string('PrimaryEMail');
            $table->integer('CellPhone');
            $table->integer('NationalityID');
            $table->integer('ProgramID');
            $table->integer('TermID');
            $table->integer('ClassLevelID');
            $table->integer('GroupID');
            $table->timestamps();

            Schema::create('marital_statuses', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('marital_statuses_id');
                $table->foreign('marital_statuses_id')->references('id')->on('marital_statuses')->onDelete('cascade');
                $table->timestamps();
            });

            Schema::create('nationalities', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('nationalities_id');
                $table->foreign('nationalities_id')->references('id')->on('nationalities')->onDelete('cascade');
                $table->timestamps();
            });

            Schema::create('religions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('religions_id');
                $table->foreign('religions_id')->references('id')->on('religions')->onDelete('cascade');
                $table->timestamps();
            });

            Schema::create('states', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('states_id');
                $table->foreign('states_id')->references('id')->on('states')->onDelete('cascade');
                $table->timestamps();
            });

            Schema::create('places', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('places_id');
                $table->foreign('places_id')->references('id')->on('places')->onDelete('cascade');
                $table->timestamps();
            });
            
            Schema::create('places', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('places_id');
                $table->foreign('places_id')->references('id')->on('places')->onDelete('cascade');
                $table->timestamps();
            });


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
