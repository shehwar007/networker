<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id')->nullable();
            $table->string('branch_user')->nullable();
            $table->double('subtotal')->nullable();
            $table->double('tax')->nullable();
            $table->double('discount')->nullable();
            $table->double('grand_total')->nullable();
            $table->string('payment_method')->nullable();  
            $table->string('payment_status')->nullable();
            $table->string('card_no')->nullable();
            $table->double('partial_payment')->nullable(); 
            $table->double('balance')->nullable();   
            $table->text('notes')->nullable(); 
            $table->string('status')->nullable(); 
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
        Schema::dropIfExists('sales');
    }
}
