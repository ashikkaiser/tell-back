<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrafficSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traffic_sources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_id');
            $table->integer('workspace_id');
            $table->integer('currency_id');
            $table->json('parameters');
            $table->string('postback_url')->nullable();
            $table->boolean('pixal_redirect_enabled');
            $table->boolean('postback_url_enabled');
            $table->string('pixal_redirect_url')->nullable();
            $table->boolean('impression_tracking');
            $table->boolean('direct_tracking');
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
        Schema::dropIfExists('traffic_sources');
    }
}
