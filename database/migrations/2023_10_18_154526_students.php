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
            $table->id('BirthPlaceID');
            $table->id('ReligionID');
            $table->string('PrimaryEMail');
            $table->integer('CellPhone');
            $table->id('NationalityID');
            $table->id('ProgramID');
            $table->id('TermID');
            $table->id('ClassLevelID');
            $table->id('GroupID');
            $table->timestamps();
        });}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
