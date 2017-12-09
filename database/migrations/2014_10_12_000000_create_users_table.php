<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('type_user_id')->unsigned()->default(1);
            $table->string('name');
            $table->string('email',100)->unique();
            //$table->boolean('email_verify')->default(1);
            //$table->string('email_token');
            $table->string('api_token')->default('admin1');
            $table->string('password');
            //$table->boolean('online');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
