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
        //
        Schema::create('families', function(Blueprint $table){

            $table->id();
            $table->string('LastName1');
            $table->string('LastName2');
            $table->string('Address1');
            $table->int('ExtNum');
            $table->int('IntNum');
            $table->string('Address2');
            $table->string('City');
            $table->string('County');
            $table->id('StateID');
            $table->int('CodigoPostal');
            $table->id('CountryID');
            $table->int('Phone1');
            $table->int('Phone2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('table');
    }
};
