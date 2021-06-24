<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablishmentUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishment_user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('establishment_name');
            $table->string('establishment_phonenum')->nullable();
            $table->string('establishment_mobilenum');
            $table->string('establishment_email')->nullable();
            $table->string('establishment_website')->nullable();
            $table->string('establishment_fb_account')->nullable();
            $table->text('historical_description')->nullable();
            $table->text('business_permit_path')->nullable();
            $table->text('valid_id_path')->nullable();
            $table->text('tax_id_path')->nullable();
            $table->unsignedBigInteger('ua_id');
            $table->foreign('ua_id')->references('id')->on('users');
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
        Schema::dropIfExists('establishment_user_infos');
    }
}
