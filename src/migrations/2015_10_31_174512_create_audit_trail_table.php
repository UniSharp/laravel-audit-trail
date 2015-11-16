<?php

use Illuminate\Database\Migrations\Migration;

class CreateAuditTrailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_trails', function ($table) {
            $table->increments('id');
            $table->string('model')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('action');
            $table->string('subject')->nullable();
            $table->string('subject_id')->nullable();
            $table->string('comment')->nullable();
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
        Schema::drop('audit_trails');
    }
}