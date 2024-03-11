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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->integer('ProgramShiftID');
            $table->unsignedBigInteger('TermID')->nullable();
            $table->foreign('TermID')->references('id')->on('terms')->onDelete('cascade');
            $table->integer('ProgramID')->nullable();
            $table->integer('ClassLevelID')->nullable();
            $table->string('Owner_CID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
