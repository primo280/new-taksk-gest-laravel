<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_tasks_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();  // ID de la tâche
            $table->string('title');  // Titre de la tâche
            $table->text('description')->nullable();  // Description de la tâche
            $table->boolean('completed')->default(false);  // Statut de la tâche
            $table->unsignedBigInteger('user_id');  // Clé étrangère vers l'utilisateur
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Relation avec la table 'users'
            $table->timestamps();  // Création des colonnes created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
    
}
