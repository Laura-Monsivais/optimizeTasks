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
            $table->id('BirthPlaceID');
            $table->string('BirthCity');
            $table->string('CURP');
            $table->integer('CellPhone');
            $table->id('PrimaryEmail');
            $table->id('MaritalStatusID');
            $table->string('WorkPlace');
            $table->string('WorkJob');
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
