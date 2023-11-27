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

/*             Schema::create('MaritalStatusID', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('MaritalStatusID');
                $table->foreign('MaritalStatusID')->references('ID')->on('marital_statuses')->onDelete('cascade');
                $table->timestamps();
            }); */

            Schema::create('NationalityID', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('NationalityID');
                $table->foreign('NationalityID')->references('ID')->on('nationalities')->onDelete('cascade');
                $table->timestamps();
            });

            Schema::create('ReligionID', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('ReligionID');
                $table->foreign('ReligionID')->references('ID')->on('religions')->onDelete('cascade');
                $table->timestamps();
            });
/* 
            Schema::create('ProgramID', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('ProgramID');
                $table->foreign('ProgramID')->references('ID')->on('PROGRAMS')->onDelete('cascade');
                $table->timestamps();
            });

            Schema::create('TermID', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('TermID');
                $table->foreign('TermID')->references('ID')->on('terms')->onDelete('cascade');
                $table->timestamps();
            });

            Schema::create('ClassLevelID', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('ClassLevelID');
                $table->foreign('ClassLevelID')->references('ID')->on('class_levels')->onDelete('cascade');
                $table->timestamps();
            });

            Schema::create('GroupID', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('GroupID');
                $table->foreign('GroupID')->references('ID')->on('groups')->onDelete('cascade');
                $table->timestamps();
            }); */


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
