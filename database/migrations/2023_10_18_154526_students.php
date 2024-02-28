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
        Schema::create('students', function (Blueprint $table) {

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
            $table->string('PrimaryEMail')->nullable();
            $table->integer('CellPhone')->nullable();
            $table->integer('ProgramID')->nullable();
            $table->integer('TermID')->nullable();
            $table->integer('ClassLevelID')->nullable();
            $table->integer('GroupID')->nullable();

            $table->unsignedBigInteger('NationalityID')->nullable();
            $table->foreign('NationalityID')->references('ID')->on('nationalities')->onDelete('cascade');

            $table->unsignedBigInteger('ReligionID')->nullable();;
            $table->foreign('ReligionID')->references('ID')->on('religions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
