<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking_domains', function (Blueprint $table) {
            $table->id();
            $table->string('domain');
            $table->integer('user_id')->nullable();
            $table->enum('protocol', ['https', 'http'])->default('http');
            $table->boolean('status');
            $table->enum('type', ['default', 'custom'])->default('custom');
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
        Schema::dropIfExists('tracking_domains');
    }
}
