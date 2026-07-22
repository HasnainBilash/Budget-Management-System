<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // First, drop foreign keys that reference projects table
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropColumn('project_id');
        });
        
        Schema::dropIfExists('projects');
        
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['not_started', 'in_progress', 'completed', 'on_hold'])->default('not_started');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        
        // Re-add the project_id column to tasks
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropColumn('project_id');
        });
        
        Schema::dropIfExists('projects');
    }
};
