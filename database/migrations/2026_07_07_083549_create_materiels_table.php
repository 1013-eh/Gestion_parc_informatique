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
        Schema::create('materiels', function (Blueprint $table) {
            $table->string('num_serie', 15)->primary();
            $table->unsignedInteger('id_sous_famille');
            $table->integer('code_bureau');
            $table->string('marque', 30);
            $table->string('modele', 30);
            $table->string('cab', 30)->unique();
            $table->string('num_marche', 30)->unique();
            $table->date('date_affectation')->useCurrent();
            $table->integer('num_ordre')->nullable();
            $table->string('machine', 30)->unique()->nullable();
            $table->enum('etat', [
                'BON',
                'EN_PANNE',
                'HORS_USAGE',
                'ARCHIVE'
            ]);

            $table->foreign('id_sous_famille')
                ->references('id_sous_famille')
                ->on('sous_familles')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreign('code_bureau')
                ->references('code_bureau')
                ->on('centres')
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
        Schema::dropIfExists('materiels');
    }
};
