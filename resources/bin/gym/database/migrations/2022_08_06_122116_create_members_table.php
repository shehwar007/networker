<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('member_no');
            $table->string('member_name');
            $table->string('member_mobile');
            $table->string('member_network')->nullable();
            $table->string('member_gender');
            $table->string('member_nic')->nullable();
            $table->string('member_category')->nullable();          
            $table->string('member_fathername')->nullable();
            $table->string('member_dob')->nullable();
            $table->string('member_image')->nullable();
            $table->text('member_diseases')->nullable();
            $table->string('member_residence')->nullable();
            $table->string('member_address')->nullable();
            $table->string('member_email')->nullable();
            $table->string('member_emergencyno')->nullable();         
            $table->string('member_registrationdate')->nullable();
            $table->string('member_registerby')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->nullable();
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
        Schema::dropIfExists('members');
    }
}
