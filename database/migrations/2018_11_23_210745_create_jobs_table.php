<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('job_title')->nullable();
            $table->string('job_slug')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('is_any_where')->nullable();
            $table->integer('salary')->default(0)->nullable(); //Salary from
            $table->integer('salary_upto')->default(0)->nullable(); //Salary to (Up range)
            $table->tinyInteger('is_negotiable')->default(0)->nullable();
            $table->enum('salary_cycle', ['monthly','yearly','weekly', 'daily', 'hourly'])->nullable();
            $table->string('salary_currency', 10)->nullable();

            $table->integer('vacancy')->nullable();
            $table->enum('gender', ['male','female','transgender', 'any']);
            $table->enum('job_type', ['full_time', 'part_time', 'contract', 'temporary', 'commission', 'internship'])->default('full_time')->nullable();
            $table->enum('exp_level', ['mid', 'entry', 'senior'])->nullable();

            $table->text('description')->nullable();
            $table->text('skills')->nullable();
            $table->text('responsibilities')->nullable();
            $table->text('educational_requirements')->nullable();
            $table->text('experience_requirements')->nullable();
            $table->text('additional_requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->text('apply_instruction')->nullable();

            $table->integer('country_id')->nullable();
            $table->string('country_name')->nullable();
            $table->integer('state_id')->nullable();
            $table->string('state_name')->nullable();
            $table->string('city_name')->nullable();

            $table->tinyInteger('experience_required_years')->default(0)->nullable(); //In Years
            $table->tinyInteger('experience_plus')->default(0)->nullable(); //In Years
            $table->integer('views')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->tinyInteger('status')->default(0)->nullable(); //0,pending,1=approved,2=blocked
            $table->string('job_id', 20)->nullable();
            $table->tinyInteger('is_premium')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
