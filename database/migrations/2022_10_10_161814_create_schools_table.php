<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('code',20);
            $table->string('name',100);
            $table->string('zip_code',10)->nullable();
            $table->string('address')->nullable();
            $table->string('representative_name',20)->nullable();
            $table->string('phone_number',20)->nullable();
            $table->string('email')->nullable();
            // $table->time('reception_finish_time');
            // $table->dataTime('reflection_date');

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
        Schema::dropIfExists('schools');
    }
};
