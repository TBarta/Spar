<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id");
            $table->string("trainer_name")->nullable();
            $table->string("field");
            $table->text("qualification")->nullable();
            $table->text("experience")->nullable();
            $table->text("program")->nullable();
            $table->string("contact")->nullable();
            $table->decimal("price")->nullable();
            $table->string("photo")->nullable();
            $table->boolean("registered")->nullable();
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
        Schema::dropIfExists('trainers');
    }
}
