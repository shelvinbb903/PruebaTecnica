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
        Schema::create('user', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('first_name', 128);
            $table->string('last_name', 128);
            $table->string('email', 64);
            $table->string('password', 200);
            $table->string('token', 255);
            $table->integer('age')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('description', 128)->nullable();
        });
        // Insert some stuff
        DB::table('user')->insert(
            array(
              'first_name' => 'John',
              'last_name' => 'Doe',
              'email' => 'user@example.com',
              'password' => sha1('SECRET'),
              'age' => 42,
              'token' => uniqid(),
              'image' => 'IMAGE'
            )
        );
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
