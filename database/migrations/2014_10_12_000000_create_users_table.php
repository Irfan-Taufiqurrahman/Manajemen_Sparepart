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
        Schema::enableForeignKeyConstraints();
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('number_phone')->unique();
            $table->string('name');
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('role_id')->references('id')->on('roles')->onDelete('cascade');
            // $table->zstring('user_photoProfile')->nullable();
            $table->string('password');
            $table->boolean('confirmed')->default(false);
            $table->rememberToken();
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
