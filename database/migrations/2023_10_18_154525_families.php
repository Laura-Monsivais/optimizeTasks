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
            $table->integer('ExtNum');
            $table->integer('IntNum')->nullable();
            $table->string('Address2');
            $table->string('City');
            $table->string('County');
            $table->integer('StateID');
            $table->integer('CodigoPostal');
            $table->integer('CountryID');
            $table->integer('Phone1')->nullable();
            $table->integer('Phone2');
            $table->timestamps();

            Schema::create('StateID', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('StateID');
                $table->foreign('StateID')->references('ID')->on('states')->onDelete('cascade');
                $table->timestamps();
            });

            Schema::create('CountryID', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('CountryID');
                $table->foreign('CountryID')->references('ID')->on('countries')->onDelete('cascade');
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
        Schema::dropIfExists('table');
    }
};
