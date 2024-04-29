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
        Schema::create('payementfacts', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->nullable();
            $table->float('virement')->nullable();
            $table->date('date')->nullable();
            $table->integer('id_facture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payementfacts');
    }
};
