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
        Schema::create('pending_votes', function (Blueprint $table) {
            // 1. Chaves Estrangeiras com Exclusão em Cascata
            $table->foreignId('poll_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // 2. Timestamps para saber quando o voto pendente foi gerado
            $table->timestamps();

            // -------------------------------------------------------------
            // CHAVES E ÍNDICES DE ALTA PERFORMANCE
            // -------------------------------------------------------------

            // 3. Primary Key Composta (Evita ID desnecessário e impede duplicações):
            // Otimiza: DELETE FROM pending_votes WHERE poll_id = X AND user_id = Y (Exclusão no voto)
            // Otimiza: SELECT * FROM pending_votes WHERE poll_id = X (Lista de pendentes da enquete)
            $table->primary(['poll_id', 'user_id']);

            // 4. Índice Composto Invertido:
            // Otimiza: SELECT * FROM pending_votes WHERE user_id = Y (Pendências do dashboard do usuário)
            $table->index(['user_id', 'poll_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_votes');
    }
};
