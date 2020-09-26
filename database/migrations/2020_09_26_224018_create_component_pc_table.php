<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentPcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_pc', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('pc_id')
            ->unsigned()
            ->index()
            ->foreign()
            ->references('id')
            ->on('pcs')
            ->onDelete('cascade');

            $table->integer('component_id')
            ->unsigned()
            ->index()
            ->foreign()
            ->references('id')
            ->on('components')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('component_pc');
    }
}
