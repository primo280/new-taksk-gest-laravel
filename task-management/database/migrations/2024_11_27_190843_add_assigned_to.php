<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Migration pour ajouter la colonne assigned_to à la table tasks
public function up()
{
    Schema::table('tasks', function (Blueprint $table) {
        $table->unsignedBigInteger('assigned_to')->nullable(); // Permet de laisser l'utilisateur assigné vide
        $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null'); // Clé étrangère
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
        });
    }
};
