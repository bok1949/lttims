<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('contact_number');
            $table->string('city_municipality');
            $table->string('province');
            $table->string('gender');
            $table->string('temperature');
            $table->string('people_with_you_male')->nullable();
            $table->string('people_with_you_female')->nullable();
            $table->string('people_with_you_lgbtq')->nullable();
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
        Schema::dropIfExists('visitor_users');
    }
}
