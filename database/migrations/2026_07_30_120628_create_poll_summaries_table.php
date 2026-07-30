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
        Schema::create('poll_historical', function (Blueprint $table) {
            $table->id();

            /**
             * IF a empresa AND group 
             * permanecem registradas,
             * o historical também permanece.
             */
            $table->foreignId('enterprise_id')->constrained()->cascadeOnDelete();
            $table->foreignId('group_id')->constrained()->cascadeOnDelete();

            /***
             * Dados referentes ao poll no models.
             * Um poll deve ser DESATIVADO ao vencimento (não excluído) de seu prazo (dead_line).
             * mas seu histórico/resumo fica aqui.
             */
            $table->foreignId('poll_id')->constrained()->cascadeOnDelete();

            

            /**
             * Tabelas:
             * alternatives e pending_votes 
             * devem sofrer exclusões permanentes de regsitros
             * mas suas informações devem ser salvas em JSON abaixo
             */
            $table->json('votes');//['Alternativa1' => $votes1, 'Alternativa2' => $votes2 ...]
            $table->json('votes_pending_after_deadline');//[$u_id1, $u_id2, ...]


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll_summaries');
    }
};
