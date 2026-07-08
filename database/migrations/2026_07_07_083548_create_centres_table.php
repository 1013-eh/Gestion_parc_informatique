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
        Schema::create('centres', function (Blueprint $table) {
            $table->integer('code_bureau')->primary();
            $table->string('nom_centre', 100)->unique();
            $table->unsignedInteger('id_region');
            $table->integer('matricule');
            $table->string('adresse_ip', 45)->unique();
            $table->string('dernier_num_ordre')->nullable();
            $table->enum('type_consultation', [
                'GLOBAL',
                'PAR_CENTRE',
                'ADMIN'
            ]);
            $table->foreign('id_region')
                ->references('id_region')
                ->on('regions')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('matricule')
                ->references('matricule')
                ->on('users')
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
        Schema::dropIfExists('centres');
    }
};
