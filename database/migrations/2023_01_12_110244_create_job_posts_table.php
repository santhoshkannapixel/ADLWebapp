<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable();
            $table->string("code")->nullable();
            $table->string("location")->nullable();
            $table->unsignedBigInteger("department_id")->nullable();
            $table->string("experience")->nullable();
            $table->longText("responsibilities")->nullable();
            $table->longText("qualification")->nullable();
            $table->string("no_of_requirement")->nullable();
            $table->foreign("department_id")->references('id')->on('departments')->onDelete('cascade');
            $table->integer("status")->default(0);
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
        Schema::dropIfExists('job_posts');
    }
}
