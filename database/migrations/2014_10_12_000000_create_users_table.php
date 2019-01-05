<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::defaultStringLength(191);

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->integer('country_id')->nullable();
            $table->string('country_name')->nullable();
            $table->integer('state_id')->nullable();
            $table->string('state_name')->nullable();
            $table->string('city')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('address')->nullable();
            $table->string('address_2')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->enum('user_type', ['user','employer','agent', 'admin']);

            $table->string('company')->nullable();
            $table->string('company_slug')->nullable();
            $table->string('company_size', 5)->nullable();
            $table->text('about_company')->nullable();
            $table->string('logo')->nullable();

            $table->integer('premium_jobs_balance')->default(0)->nullable();
            //active_status 0:pending, 1:active, 2:block;
            $table->tinyInteger('active_status')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
