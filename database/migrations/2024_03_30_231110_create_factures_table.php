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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('num')->nullable();
            $table->text('sujet')->nullable();
            $table->float('MTTTC')->default(0);
            $table->float('MTHT')->default(0);
            $table->float('totTVA')->default(0);
            $table->float('rest')->default(0);
            $table->integer('id_devi')->nullable();
            $table->integer('id_client')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
