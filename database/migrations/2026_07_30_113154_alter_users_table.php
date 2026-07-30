<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Users é dependente de Enterprise.
     * Todo usuário pertence a uma organização/empresa
     * 
     * Regra que será implementada na camada de serviço:
     * Apenas usuários da mesma empresa podem participar de mesmos grupo.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('enterprise_id')->constrained()->cascadeOnDelete();

            $table->index('enterprise_id'); // Otimizado para implementação de regra.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
