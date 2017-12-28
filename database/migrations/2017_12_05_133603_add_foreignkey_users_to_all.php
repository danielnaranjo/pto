<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyUsersToAll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::dropIfExists('user_data');
        //
        // Schema::table('user_info', function (Blueprint $table) {
        //     $table->bigInteger('user_id')->after('user_info_id');
        //     $table->foreign('user_id')->references('id')->on('users');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // $table->dropForeign(['user_id']);
        //
        // Schema::table('user_info', function($table) {
        //     $table->dropColumn('user_id');
        // });
    }
}
