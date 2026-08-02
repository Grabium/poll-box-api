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

            /***
             * Os atributos enterprise_id e poll_id não poderão serão excluídos em funcionalidades fornecidas ao usuário final.
             * A única possibilidade de exclusão se dará unicamente pela equipe de suporte do software.
             * As chamadas da função cascadeOnDelete() são apenas para facilitar o suporte com consciência do que faz.
            */

            
            $table->foreignId('enterprise_id')->constrained()->cascadeOnDelete();

            /***
             * Dados referentes ao group no models.
             * Um group poderá ser DESATIVADO pelo seu manager.
             * mas seu histórico/resumo fica aqui.
             */
            $table->foreignId('group_id')->constrained()->cascadeOnDelete();

            /**
             * O usuário final pode apenas DESATIVAR Poll, 
             * mas seu registro permanece fundamental aqui e em outra tabela (votes_receipts).
             */
            $table->foreignId('poll_id')->unique()->constrained()->cascadeOnDelete();     

            /**
             * Snapshots das tabelas:
             * alternatives e pending_votes 
             * devem sofrer exclusões de regsitros,
             * mas suas informações devem ser salvas em JSON abaixo
             * seja no momento do encerramento da enquete ou desativação manual por parte do manager.
             */
            $table->json('votes');//['Alternativa1' => $votes1, 'Alternativa2' => $votes2 ...]
            $table->json('votes_pending_after_deadline');//[$u_id1, $u_id2, ...]

            $table->timestamps();

            // -------------------------------------------------------------
            // ÍNDICES DE PERFORMANCE PARA RELATÓRIOS
            // -------------------------------------------------------------
            
            // Permite filtrar relatórios de histórico por Empresa + Grupo rapidamente
            $table->index(['enterprise_id', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll_historical');
    }
};
