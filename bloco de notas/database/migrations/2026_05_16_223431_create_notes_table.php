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
       Schema::create('notes', function (Blueprint $table) {
        $table->id();
        // Associa a nota ao usuário (Dono da nota)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->text('content'); // Conteúdo onde salvaremos criptografado
        $table->timestamps(); // Registro automático de criação e edição (created_at e updated_at)
        $table->softDeletes(); // Registro automático de exclusão (deleted_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
