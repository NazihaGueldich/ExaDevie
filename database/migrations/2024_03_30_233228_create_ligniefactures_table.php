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
        Schema::create('ligniefactures', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->nullable();
            $table->text('designiation')->nullable();
            $table->integer('id_produit')->nullable();
            $table->float('prix')->nullable();
            $table->float('prixT')->nullable();
            $table->float('tva')->nullable();
            $table->float('tht')->nullable();
            $table->float('ptttc')->nullable();
            $table->float('quantiter')->nullable();
            $table->integer('id_facture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligniefactures');
    }
};
