<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusRemarkClinicalLabManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinical_lab_management', function (Blueprint $table) {
            $table->string('status')->after('message')->nullable();
            $table->longText('remark')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinical_lab_management', function (Blueprint $table) {
            $table->string('status')->after('message')->nullable();
            $table->longText('remark')->after('status')->nullable();
        });
    }
}
