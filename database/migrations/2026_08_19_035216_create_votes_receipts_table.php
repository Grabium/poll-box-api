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
        Schema::create('votes_receipts', function (Blueprint $table) {
            $table->id();

            /***
             * Dados referentes ao poll no models.
             * Um poll deve ser DESATIVADO ao vencimento (não excluído) de seu prazo (dead_line).
             * mas seu histórico/resumo fica aqui.
             */
            $table->foreignId('poll_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamp('date_vote'); // now()->setTimezone('America/Sao_Paulo')->toDateTimeString(); // formato americano fuzo brasil (yyyy-mm-dd hh:mm:ss)
            $table->string('vote_code', 22)->unique();// Armazena o código numérico gerado (22 caracteres)


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes_receipts');
    }
};
