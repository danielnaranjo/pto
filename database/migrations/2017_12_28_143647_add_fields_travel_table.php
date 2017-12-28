<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travel', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('weight')->nullable();
            $table->string('restrictions')->nullable();
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
            $table->dropColumn('title');
            $table->dropColumn('dimensions');
            $table->dropColumn('weight');
            $table->dropColumn('restrictions');
        });
    }
}
