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
        Schema::create('group_user', function (Blueprint $table) {


            // Se a tabela for puramente uma pivot simples de associação, 
            // você PODE omitir o $table->id() para economizar armazenamento/I/O, 
            // tornando a combinação dos dois IDs a própria Primary Key.

            //$table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('group_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            // -------------------------------------------------------------
            // OTIMIZAÇÕES DE ÍNDICE
            // -------------------------------------------------------------

            // 1. PRIMARY KEY composta (ou UNIQUE KEY se usar $table->id()):
            // Atende a Pesquisa "Todos os grupos em que um usuário X está inscrito" (user_id = X)
            // Atende a Pesquisa "Se um usuário X específico está inscrito em um grupo Y específico" (user_id = X AND group_id = Y)
            // Impede inscrições duplicadas no nível do banco.
            $table->primary(['user_id', 'group_id']);

            // 2. ÍNDICE COMPOSTO Invertido:
            // Atende a Pesquisa "Todos os usuários inscritos em um grupo Y específico" (group_id = Y)
            // Também atende a Pesquisa "Se um usuário X específico está inscrito em um grupo Y específico" (group_id = Y AND user_id = X)
            $table->index(['group_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_user');
    }
};
