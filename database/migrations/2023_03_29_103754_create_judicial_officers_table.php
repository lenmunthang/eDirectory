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
        Schema::create('judicial_officers', function (Blueprint $table) {
            $table->id('jo_id');
            $table->integer('jo_code')->nullable();
            $table->char('jo_title', 4);
            $table->string('jo_first_name', 100);
            $table->string('jo_middle_name', 100)->nullable();
            $table->string('jo_last_name', 100)->nullable();
            $table->string('jo_name');
            $table->string('jo_photo')->nullable();
            $table->integer('jo_grade');
            $table->integer('jo_priority');
            $table->string('jo_designation', 200);
            $table->char('jo_mslsa', 1)->nullable();
            $table->char('jo_msja', 1)->nullable();
            $table->json('jo_pop_district', 10);
            $table->json('jo_pop_sub_div', 10)->nullable();
            $table->date('jo_dob')->nullable();
            $table->string('jo_qualification', 50)->nullable();
            $table->date('jo_doa')->nullable();
            $table->char('jo_display', 1);
            $table->char('jo_telephone_no', 20)->nullable();
            $table->char('jo_fax_no', 20)->nullable();
            $table->string('jo_mobile_no', 20)->nullable();
            $table->string('jo_email_id', 100)->nullable();
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
        Schema::dropIfExists('judicial_officers');
    }
};
