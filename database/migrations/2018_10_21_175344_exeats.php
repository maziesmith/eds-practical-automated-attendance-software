<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Exeats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('exeats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_id');
            $table->enum('status', ['APPROVED','PENDING', 'DECLINED'])->default('APPROVED');
            $table->date('start');
            $table->date('end');
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
        //
        Schema::dropIfExists('exeats');
    }
}
