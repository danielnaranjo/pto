<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFielsToTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('travel', function (Blueprint $table) {
            $table->dateTime('created_at');
            $table->char('status', 1)->default('0');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
        Schema::table('travel', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('status');
        });
     }
}
