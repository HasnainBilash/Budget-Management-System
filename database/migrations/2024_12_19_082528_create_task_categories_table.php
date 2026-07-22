<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('task_categories')) {
            Schema::create('task_categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('color')->default('#2ecc71');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('task_categories');
    }
};