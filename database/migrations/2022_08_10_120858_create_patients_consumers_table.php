<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsConsumersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients_consumers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('date')->nullable();
            $table->string('gender')->nullable();
            $table->string('test_for_home_collection')->nullable();
            $table->string('upload_prescription')->nullable();
            $table->string('preferred_date_1')->nullable();
            $table->string('preferred_date_2')->nullable();
            $table->string('preferred_time')->nullable();
            $table->string('address')->nullable();
            $table->string('pincode')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('patients_consumers');
    }
}
