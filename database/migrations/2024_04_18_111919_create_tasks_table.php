<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('department_id');
            $table->integer('project_id');
            $table->string('task_title');
            $table->enum('project_priority', ['Low', 'Medium', 'High']);
            $table->datetime('start_date');
            $table->float('duration',10,2);
            $table->enum('duration_unit', ['Day', 'Month', 'Week', 'Year']);
            $table->datetime('end_date');
            $table->enum('status', ['Pending', 'Start', 'On going', 'Testing' 'Completed'])->default('Pending');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
