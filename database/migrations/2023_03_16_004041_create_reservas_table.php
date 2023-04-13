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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->unsignedBigInteger('equipamento_id')->comment('Identificador global de equipamentos')->nullable();
            $table->foreign('equipamento_id')->references('id')->on('equipamentos');
            $table->unsignedBigInteger('local_id')->comment('Identificador global de locais')->nullable();
            $table->foreign('local_id')->references('id')->on('locais');
            $table->unsignedBigInteger('cliente_id')->comment('Identificador global de clientes')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->date('data');
            $table->time('horario');
            $table->timestamp('devolucao')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
