<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Chave estrangeira para posts
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Chave estrangeira para usuários
            $table->text('content'); // Conteúdo do comentário
            $table->timestamps(); // Campos de timestamps (created_at, updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
