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
        Schema::create('demndcongs', function (Blueprint $table) {
            $table->id();
            $table->datetime('dateD')->nullable();
            $table->datetime('dateF')->nullable();
            $table->integer('etat')->default(0);
            $table->string('cause')->nullable();
            $table->integer('id_employe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demndcongs');
    }
};
