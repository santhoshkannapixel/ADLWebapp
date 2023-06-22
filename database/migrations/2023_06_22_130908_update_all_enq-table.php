<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAllEnqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_home_collections', function (Blueprint $table) {
            $table->text('page_url')->nullable();
        });
        Schema::table('patients_consumers', function (Blueprint $table) {
            $table->text('page_url')->nullable();
        });
        Schema::table('feed_backs', function (Blueprint $table) {
            $table->text('page_url')->nullable();
        });
        Schema::table('frequently_asked_questions', function (Blueprint $table) {
            $table->text('page_url')->nullable();
        });
        Schema::table('hospital_lab_management', function (Blueprint $table) {
            $table->text('page_url')->nullable();
        });
        Schema::table('clinical_lab_management', function (Blueprint $table) {
            $table->text('page_url')->nullable();
        });
        Schema::table('franchising_opportunities', function (Blueprint $table) {
            $table->text('page_url')->nullable();
        });
        Schema::table('research', function (Blueprint $table) {
            $table->text('page_url')->nullable();
        });
        Schema::table('book_appointments', function (Blueprint $table) {
            $table->text('page_url')->nullable();
        });
        Schema::table('head_offices', function (Blueprint $table) {
            $table->text('page_url')->nullable();
        });
        Schema::table('careers', function (Blueprint $table) {
            $table->text('page_url')->nullable();
        });
        Schema::table('contact_us', function (Blueprint $table) {
            $table->text('page_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_home_collections', function (Blueprint $table) {
            //
        });
    }
}
