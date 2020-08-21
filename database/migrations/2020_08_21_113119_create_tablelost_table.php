<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablelostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablelost', function (Blueprint $table) {
            $table->increments('lost_id');
            $table->string('lost_name');
            $table->string('lost_time');
            $table->string('lost_place');
            $table->string('lost_detail');
            $table->string('lost_img');
            $table->string('lost_person');
            $table->string('lost_phone');
            $table->string('lost_status');
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
        Schema::dropIfExists('tablelost');
    }
}
