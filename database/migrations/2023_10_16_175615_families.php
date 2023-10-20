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
            $table->integer('IntNum');
            $table->string('Address2');
            $table->string('City');
            $table->string('County');
            $table->integer('StateID');
            $table->integer('CodigoPostal');
            $table->integer('CountryID');
            $table->integer('Phone1');
            $table->integer('Phone2');

            $table->foreignId('id_states') 
            ->nullable()
            ->constrained('states')
            ->cascadeOnUpdate()
            ->nullOnDelete();
            $table->timestamps();

            $table->foreignId('id_countries') 
            ->nullable()
            ->constrained('countries')
            ->cascadeOnUpdate()
            ->nullOnDelete();
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
