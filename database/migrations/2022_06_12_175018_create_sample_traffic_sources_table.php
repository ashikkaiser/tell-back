<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleTrafficSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_traffic_sources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('parameters');
            $table->integer('workspace_id');
            $table->integer('currency_id');
            $table->string('postback_url')->nullable();
            $table->string('pixal_redirect_url')->nullable();
            $table->boolean('impression_tracking');
            $table->boolean('direct_tracking');
            $table->boolean('pixal_redirect_enabled')->default(false);
            $table->boolean('postback_url_enabled')->default(false);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('sample_traffic_sources');
    }
}
