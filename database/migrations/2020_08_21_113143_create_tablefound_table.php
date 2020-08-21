<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablefoundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablefound', function (Blueprint $table) {
            $table->increments('found_id');
            $table->string('found_name');
            $table->string('found_time');
            $table->string('found_place');
            $table->string('found_detail');
            $table->string('found_img');
            $table->string('found_person');
            $table->string('found_phone');
            $table->string('found_status');
            $table->date('created_at');
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
        Schema::dropIfExists('tablefound');
    }
}
