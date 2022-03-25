<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->double('total_price', 8, 2)->nullable();
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

   
     
     
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
