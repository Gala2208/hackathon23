<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->references('id')->on('projects');
            $table->foreignId('type_id')->references('id')->on('users');
            $table->foreignId('status_id')->references('id')->on('statuses');
            $table->string('work_name');
            $table->string('prod_name');
            $table->string('units');
            $table->integer('count');
            $table->string('supplier_or_performer');
            $table->string('date_of_payment_plan')->nullable();
            $table->string('date_of_payment_fact')->nullable();
            $table->string('date_of_start_plan')->nullable();
            $table->string('date_of_start_fact')->nullable();
            $table->string('date_of_end_plan')->nullable();
            $table->string('date_of_end_fact')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
