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
            $table->boolean('is_group_manager')->default(false); // Indica se o usuário é gerente de grupo (group manager) ou não
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove a foreign key e a coluna
        $table->dropForeign(['enterprise_id']);
        $table->dropColumn('enterprise_id');
    }
};
