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
            $table->boolean('is_admin');
            $table->enum('account_type', ['company', 'individual']);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('im');
            $table->string('password');
            $table->string('fb_link')->nullable();
            $table->string('web_link')->nullable();
            $table->string('address1');
            $table->string('city');
            $table->string('state');
            $table->integer('country_id');
            $table->string('zip');
            $table->string('phone');
            $table->integer('package_id')->nullable();
            $table->enum('status', ['pending', 'active', 'suspend']);
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
