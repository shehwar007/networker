<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreezeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freeze_items', function (Blueprint $table) {
            $table->id();
            $table->string('sale_item_id')->nullable(); 
            $table->integer('days_used')->nullable(); 
            $table->integer('days_left')->nullable(); 
            $table->string('freeze_status')->nullable(); 
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
        Schema::dropIfExists('freeze_items');
    }
}
