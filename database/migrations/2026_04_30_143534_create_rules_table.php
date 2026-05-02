<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::create('rules', function (Blueprint $table) {
        $table->id();
        $table->foreignId('penyakit_id')->constrained('penyakits')->onDelete('cascade');
        $table->foreignId('gejala_id')->constrained('gejalas')->onDelete('cascade');
        $table->float('bobot_pakar');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
