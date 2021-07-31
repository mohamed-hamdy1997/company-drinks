<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeDrinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_drinks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('drink_id')->unsigned()->nullable();
            $table->string('drink_name')->nullable();
            $table->string('hint')->nullable();
            $table->integer('status')->default(0);
            $table->integer('floor_number')->nullable();
            $table->bigInteger('maker_id')->unsigned()->nullable();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('drink_id')->references('id')->on('drinks')
                ->onDelete('SET NULL')->onUpdate('SET NULL');

            $table->foreign('maker_id')->references('id')->on('users')
                ->onDelete('SET NULL')->onUpdate('SET NULL');
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
        Schema::dropIfExists('employee_drinks');
    }
}
