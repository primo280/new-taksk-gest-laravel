<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_user_id_to_tasks_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToTasksTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('tasks', 'user_id')) {
            Schema::table('tasks', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('tasks', 'user_id')) {
            Schema::table('tasks', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }
    }
}
