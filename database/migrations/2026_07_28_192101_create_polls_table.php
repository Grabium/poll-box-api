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
        Schema::create('polls', function (Blueprint $table) {
            $table->id();          
            $table->foreignId('group_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_active')->default(true);
            $table->string('name', 50);
            $table->string('question', 400);
            $table->boolean('pending_users_visibility');
            $table->timestamp('dead_line'); // now()->setTimezone('America/Sao_Paulo')->toDateTimeString(); // formato americano fuzo brasil (yyyy-mm-dd hh:mm:ss)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polls');
    }
};
