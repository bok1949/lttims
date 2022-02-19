<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablishmentPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishment_photos', function (Blueprint $table) {
            $table->id();
            $table->text('img_caption')->nullable();
            $table->boolean('is_main');
            $table->string('image_path');
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
        Schema::dropIfExists('establishment_photos');
    }
}
