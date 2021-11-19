<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streams_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stream_id');
            $table->foreign('stream_id')->references('id')->on('streams')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streams_tags');
    }
}
