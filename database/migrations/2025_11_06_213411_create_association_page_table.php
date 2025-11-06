<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('association_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('association_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Nome da página
            $table->string('slug')->unique(); // URL amigável
            $table->enum('type', ['builder', 'html'])->default('builder'); // Tipo: construtor ou HTML importado
            $table->longText('content')->nullable(); // Conteúdo HTML (para tipo html)
            $table->json('components')->nullable(); // Componentes estruturados (para tipo builder)
            $table->json('settings')->nullable(); // Configurações da página (meta tags, scripts, etc)
            $table->boolean('is_published')->default(false); // Publicada ou rascunho
            $table->boolean('is_home')->default(false); // É a página inicial da associação
            $table->integer('order')->default(0); // Ordem de exibição
            $table->timestamps();
            
            $table->index(['association_id', 'is_published']);
            $table->index(['association_id', 'is_home']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('association_pages');
    }
};
