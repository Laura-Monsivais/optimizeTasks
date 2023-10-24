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
        Schema::create('persons', function(Blueprint $table){

            $table->id();
            $table->string('Name');
            $table->string('Last');
            $table->string('Last2');
            $table->char('Gender');
            $table->date('BirthDate');
            $table->integer('BirthPlaceID');
            $table->string('BirthCity');
            $table->string('CURP');
            $table->integer('CellPhone');
            $table->integer('PrimaryEmail');
            $table->integer('MaritalStatusID');
            $table->string('WorkPlace');
            $table->string('WorkJob');
            $table->timestamps();

        });

        Schema::create('MaritalStatusID', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('MaritalStatusID');
            $table->foreign('MaritalStatusID')->references('ID')->on('marital_statuses')->onDelete('cascade');
            $table->timestamps();       
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
