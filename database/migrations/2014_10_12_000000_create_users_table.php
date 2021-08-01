<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('password_for_admin');
            $table->rememberToken();
//            $table->foreignId('current_team_id')->nullable();
//            $table->string('profile_photo_path', 2048)->nullable();
            $table->bigInteger('phone_number')->nullable();
            $table->integer('type');
            $table->integer('number_of_drinks')->default(0);
            $table->integer('number_of_drinks_ordered')->default(0);
            $table->integer('floor')->nullable();
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
        Schema::dropIfExists('users');
    }
}
