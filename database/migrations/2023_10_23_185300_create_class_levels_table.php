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
        Schema::create('class_levels', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Short');
            $table->integer('CurrentCap');
            $table->integer('FutureCap');
            $table->integer('GroupCap');
            $table->integerid('NivelEducativoID');
            $table->string('SEPName');
            $table->integer('Accounting');
            $table->integer('Visible');
            $table->integer('Delta');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_levels');
    }
};
