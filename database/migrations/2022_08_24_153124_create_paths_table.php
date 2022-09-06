<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paths', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('path_destination', ['offer', 'offer_and_lander']);
            $table->string('redirect_mode');
            $table->boolean('weight_optimization');
            $table->integer('campaign_id')->nullable();
            $table->integer('user_id');
            $table->integer('flow_id')->nullable();
            $table->integer('rule_id')->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('is_campaign');
            $table->json('offers')->nullable();;
            $table->json('landers')->nullable();;
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
        Schema::dropIfExists('paths');
    }
}
