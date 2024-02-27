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
            $table->string('FamilyID')->nullable();
            $table->string('Name');
            $table->string('Last');
            $table->string('Last2');
            $table->char('Gender');
            $table->string('CURP');
            $table->string('MaritalStatusID')->nullable();
            $table->date('BirthDate')->nullable();
            $table->string('BirthCity')->nullable();
            $table->integer('BirthPlaceID')->nullable();
            $table->integer('ReligionID')->nullable();
            $table->string('PrimaryEMail')->nullable();
            $table->integer('CellPhone')->nullable();
            $table->integer('NationalityID')->nullable();
            $table->integer('ProgramID')->nullable();
            $table->integer('TermID')->nullable();
            $table->integer('ClassLevelID')->nullable();
            $table->integer('GroupID')->nullable();
            $table->timestamps();



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
