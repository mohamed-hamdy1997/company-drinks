<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSugarNoToEmployeeDrinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_drinks', function (Blueprint $table) {
            $table->integer('sugar_num')->after('hint')->default(0);
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
            $table->dropColumn('sugar_num');
        });
    }
}
