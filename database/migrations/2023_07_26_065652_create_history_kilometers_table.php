<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryKilometersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_kilometers', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->nullable();
            $table->foreignId('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->string('description')->nullable();
            $table->string('image');
            $table->string('createdBy');
            $table->date('tanggal');
            $table->string('status_service')->default('no'); //add this column for service time
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
        Schema::dropIfExists('history_kilometers');
    }
}
