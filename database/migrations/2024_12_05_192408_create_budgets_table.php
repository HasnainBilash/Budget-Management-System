<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id(); // Use Laravel's default primary key name
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('month_year');
            $table->string('category');
            $table->decimal('budget_amount', 10, 2);
            $table->decimal('remaining_amount', 10, 2)->nullable();
            $table->timestamps();
        });
        
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};

