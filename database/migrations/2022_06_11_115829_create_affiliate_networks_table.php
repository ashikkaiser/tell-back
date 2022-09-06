<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliateNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_networks', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('workspace_id');
            $table->string('name');
            $table->integer('domain_id');
            $table->integer('tracking_method_id');
            $table->string('postback_url');
            $table->integer('currency_id');
            $table->json('parameters');
            $table->boolean('append_click_id');
            $table->boolean('accept_duplicate_postBack');
            $table->boolean('accept_from_whitelist_only');
            $table->json('whiteListIPs')->nullable();
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
        Schema::dropIfExists('affiliate_networks');
    }
}
