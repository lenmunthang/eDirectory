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
        Schema::create('judge', function (Blueprint $table) {
            $table->id('jd_id');
            $table->char('jd_title', 4);
            $table->string('jd_first_name', 100);
            $table->string('jd_middle_name', 100)->nullable();
            $table->string('jd_last_name', 100)->nullable();
            $table->string('jd_name');
            $table->string('jd_photo')->nullable();
            $table->date('jd_dob');
            $table->string('jd_qual', 100);
            $table->date('dt_enroll');
            $table->date('dt_ele')->nullable();
            $table->date('dt_appt')->nullable();
            $table->char('jd_display', 1);
            $table->integer('jd_desg');
            $table->char('jd_telephone_no', 20)->nullable();
            $table->char('jd_fax_no', 20)->nullable();
            $table->string('jd_mobile_no', 20)->nullable();
            $table->string('jd_email_id', 100)->nullable();
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
        Schema::dropIfExists('judge');
    }
};
