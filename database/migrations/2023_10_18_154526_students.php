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

            
            $table->foreignId('id_places') 
            ->nullable()
            ->constrained('places')
            ->cascadeOnUpdate()
            ->nullOnDelete();
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
