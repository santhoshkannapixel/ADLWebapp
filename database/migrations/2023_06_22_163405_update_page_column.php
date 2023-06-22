<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePageColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients_consumers', function (Blueprint $table) {
            $table->text('page')->nullable();
        });
        Schema::table('feed_backs', function (Blueprint $table) {
            $table->text('page')->nullable();
        });
        Schema::table('frequently_asked_questions', function (Blueprint $table) {
            $table->text('page')->nullable();
        });
        Schema::table('hospital_lab_management', function (Blueprint $table) {
            $table->text('page')->nullable();
        });
        Schema::table('clinical_lab_management', function (Blueprint $table) {
            $table->text('page')->nullable();
        });
        Schema::table('franchising_opportunities', function (Blueprint $table) {
            $table->text('page')->nullable();
        });
        Schema::table('research', function (Blueprint $table) {
            $table->text('page')->nullable();
        });
        Schema::table('book_appointments', function (Blueprint $table) {
            $table->text('page')->nullable();
        });
        Schema::table('head_offices', function (Blueprint $table) {
            $table->text('page')->nullable();
        });
        Schema::table('careers', function (Blueprint $table) {
            $table->text('page')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
