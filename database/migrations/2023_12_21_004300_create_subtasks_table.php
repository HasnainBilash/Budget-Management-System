<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('subtasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('status', ['to_do', 'in_progress', 'done'])->default('to_do');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subtasks');
    }
};
