<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gestion', function (Blueprint $table) {
            $table->id();

            $table->string('RECURSO');
            $table->integer('NRO_IMPONIBLE');
            $table->mediumText('PERIODOS');
            $table->integer('MONTO_TOTAL');
            $table->date('INICIO');
            $table->date('FINALIZACION')->nullable();
            $table->string('ESTADO');
            $table->mediumText('OBSERVACION')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gestion');
    }
};
