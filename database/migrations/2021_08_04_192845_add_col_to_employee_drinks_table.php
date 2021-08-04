<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColToEmployeeDrinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_drinks', function (Blueprint $table) {
            $table->integer('num_drinks')->default(1)->after('hint');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_drinks', function (Blueprint $table) {
            $table->dropColumn('num_drinks');
        });
    }
}
