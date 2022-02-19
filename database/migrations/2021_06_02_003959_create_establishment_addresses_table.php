<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablishmentAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishment_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('frbs');/* floor#/RM#/Bldg#/Street */
            $table->string('barangay');
            $table->string('municipality');
            $table->string('province');
            $table->string('zip');
            $table->unsignedBigInteger('eui_id');
            $table->foreign('eui_id')->references('id')->on('establishment_user_infos')->onDelete('cascade');
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
        Schema::dropIfExists('establishment_addresses');
    }
}
