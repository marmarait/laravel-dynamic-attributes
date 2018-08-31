<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DynamicAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marmarait_attributes', function (Blueprint $table) {
            $table->string('subject_type')->index();
            $table->unsignedInteger('subject_id')->index();
            $table->string('varname')->index();
            $table->string('vartype')->default('string');

            $table->string('string_value')->index()->nullable();
            $table->text('text_value')->nullable();
            $table->integer('int_value')->index()->nullable();
            $table->double('double_value')->index()->nullable();
            $table->longText('object_value')->nullable();
            $table->date('date_value')->index()->nullable();
            $table->time('time_value')->index()->nullable();
            $table->dateTime('datetime_value')->index()->nullable();

            $table->primary(['subject_type', 'subject_id', 'varname']);
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
        Schema::dropIfExists('marmarait_attributes');
    }
}
