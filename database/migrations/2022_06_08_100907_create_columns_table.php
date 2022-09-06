<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('columns', function (Blueprint $table) {
            $table->id();
            $table->enum('column_for', ["networks", "offers", "campaigns", "global", "flows", 'traffic_source', 'landers']);
            $table->integer('user_id')->nullable();
            $table->string('name');
            $table->string('column');
            $table->integer('seq');
            $table->boolean('visibilty');
            $table->longText('tooltip')->default(" ");
            $table->double('width');
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
        Schema::dropIfExists('columns');
    }
}
