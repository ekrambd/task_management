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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('client_id');
            $table->integer('department_id');
            $table->string('project_name');
            $table->enum('project_priority', ['Low', 'Medium', 'High']);
            $table->datetime('start_date');
            $table->float('duration',10,2);
            $table->enum('duration_unit', ['Day', 'Month', 'Week', 'Year']);
            $table->datetime('end_date');
            $table->float('project_cost', 10,2)->default('0.00');
            $table->enum('status', ['Pending', 'Confirm', 'On going', 'Completed', 'Finished', 'Cancel'])->default('Pending');
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
        Schema::dropIfExists('projects');
    }
};
