<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_cases', function (Blueprint $table) {
            $table->id();
            $table->dateTime('update_date_time');
            $table->integer('local_new_cases')->default(0);
            $table->integer('local_total_cases');
            $table->integer('local_total_number_of_individuals_in_hospitals')->default(0);
            $table->integer('local_deaths');
            $table->integer('local_new_deaths')->default(0);
            $table->integer('local_recovered');
            $table->integer('local_active_cases')->default(0);
            $table->integer('global_new_cases')->default(0);
            $table->bigInteger('global_total_cases');
            $table->integer('global_deaths');
            $table->integer('global_new_deaths')->default(0);
            $table->bigInteger('global_recovered');
            $table->bigInteger('total_pcr_testing_count');
            $table->bigInteger('total_antigen_testing_count');
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
        Schema::dropIfExists('covid_cases');
    }
}
