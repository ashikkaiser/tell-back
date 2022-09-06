<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('user_id');
            $table->integer('workspace_id');
            $table->integer('affiliate_network_id');
            $table->integer('country_id');
            $table->string('offer_url');
            $table->integer('domain_id');
            $table->json('tags')->nullable();
            $table->enum('payout_type', ['Auto', 'Manual']);
            $table->double('payout')->nullable();
            $table->integer('currency_id');
            $table->boolean('cap_enabled');
            $table->json('cap_size')->nullable();
            $table->integer('tracking_method_id');
            $table->integer('time_zone_id')->nullable();
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
        Schema::dropIfExists('offers');
    }
}
