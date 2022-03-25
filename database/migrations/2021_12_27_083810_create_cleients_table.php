<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCleientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name');
            $table->unsignedBigInteger('phon_number')->length(20);
            $table->char('email');
            $table->timestamps();
        });
    }

  

    
    public function down()
    {
        Schema::dropIfExists('cleients');
    }
}
