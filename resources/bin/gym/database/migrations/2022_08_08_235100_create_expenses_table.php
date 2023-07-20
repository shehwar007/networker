<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('expense_title');    
            $table->string('expense_category');
            $table->string('expense_amount');
            $table->string('expense_date');
            $table->enum('expense_payment_type', ['Cash', 'Card']);         
            $table->text('expense_description')->nullable();
            $table->string('expense_attachment')->nullable();
            $table->enum('status', ['Paid', 'Unpaid'])->nullable();         
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
        Schema::dropIfExists('expenses');
    }
}
