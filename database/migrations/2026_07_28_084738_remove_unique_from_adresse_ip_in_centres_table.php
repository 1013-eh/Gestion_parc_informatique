<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Schema::table('centres', function (Blueprint $table) {
        //     $table->dropUnique('centres_adresse_ip_unique');
        // });
    }

    public function down(): void
    {
        // Schema::table('centres', function (Blueprint $table) {
        //     $table->unique('adresse_ip');
        // });
    }
};