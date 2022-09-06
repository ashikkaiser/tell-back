<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleAffiliateNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_affiliate_networks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('domain_id');
            $table->enum('postback_method', ["postback_url", "pixel", "pixel_url"])->default('postback_url');
            $table->string('postback_url');
            $table->integer('currency_id');
            $table->json('parameters');
            $table->boolean('append_click_id');
            $table->boolean('accept_duplicate_postBack');
            $table->boolean('accept_from_whitelist_only');
            $table->json('whiteListIPs');
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
        Schema::dropIfExists('sample_affiliate_networks');
    }
}
