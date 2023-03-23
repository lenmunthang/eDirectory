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
        Schema::create('sub_division', function (Blueprint $table) {
            $table->id('sub_div_code');
            $table->unsignedBigInteger('dist_code'); 
            $table->foreign('dist_code')->references('dist_code')->on('district')->onDelete('cascade');
            // $table->foreignId('dist_code')->constrained('district')->onDelete('cascade');
            $table->string('sub_div_name', 50);
            $table->char('display', 1);
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
        Schema::dropIfExists('sub_division');
    }
};
