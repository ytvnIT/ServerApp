<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Diemdanh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diemdanh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MAHV', 10);
            $table->string('MAMH', 10);
            $table->string('MALOP', 3);
            $table->tinyInteger('SOBUOI')->default(0);
            $table->string("DIEMDANH")->default("");
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
        Schema::dropIfExists('diemdanh');
    }
}
