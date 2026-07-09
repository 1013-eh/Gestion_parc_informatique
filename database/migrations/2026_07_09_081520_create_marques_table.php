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
        Schema::create('marques', function (Blueprint $table) {
            $table->increments('id_marque')->primary();
            $table->string('nom_marque', 50)->unique();
            $table->unsignedInteger('id_sous_famille');
             $table->foreign('id_sous_famille')
                  ->references('id_sous_famille')
                  ->on('sous_familles')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marques');
    }
};
