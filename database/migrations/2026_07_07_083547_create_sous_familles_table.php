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
        Schema::create('sous_familles', function (Blueprint $table) {
            $table->increments('id_sous_famille');
            $table->string('nom_sous_famille',60);
            $table->unsignedInteger('id_famille');
            $table->foreign('id_famille')
                  ->references('id_famille')
                  ->on('familles')
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
        Schema::dropIfExists('sous_familles');
    }
};
