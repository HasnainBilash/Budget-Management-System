<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Update 'done' to 'completed'
        DB::table('tasks')
            ->where('status', 'done')
            ->update(['status' => 'completed']);

        // Update 'to_do' to 'not_started'
        DB::table('tasks')
            ->where('status', 'to_do')
            ->update(['status' => 'not_started']);
    }

    public function down()
    {
        // Update 'completed' back to 'done'
        DB::table('tasks')
            ->where('status', 'completed')
            ->update(['status' => 'done']);

        // Update 'not_started' back to 'to_do'
        DB::table('tasks')
            ->where('status', 'not_started')
            ->update(['status' => 'to_do']);
    }
};
