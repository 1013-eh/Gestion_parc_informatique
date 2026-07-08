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
        Schema::create('archives', function (Blueprint $table) {
            $table->integer('id_archive')->primary()->autoIncrement();
<<<<<<< HEAD
            $table->string('num_serie', 15);
=======
            $table->string('num_serie',15);
>>>>>>> origin/develop
            $table->string('description',200);
            $table->date('date_archivage')->useCurrent();
            $table->foreign('num_serie')
                  ->references('num_serie')
                  ->on('materiels')
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
        Schema::dropIfExists('archives');
    }
};
