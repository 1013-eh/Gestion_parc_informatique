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
        Schema::create('historique_responsables', function (Blueprint $table) {
            $table->id();

            $table->integer('code_bureau');
            $table->Integer('ancien_matricule');
            $table->Integer('nouveau_matricule');

            $table->timestamp('date_changement')->useCurrent();

            $table->foreign('code_bureau')
                ->references('code_bureau')
                ->on('centres')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_responsables');
    }
};
