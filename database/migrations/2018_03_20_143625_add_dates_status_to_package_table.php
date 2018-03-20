<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatesStatusToPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('package', function (Blueprint $table) {
           $table->dateTime('taken')->after('created');
           $table->dateTime('transit')->after('taken');
           $table->dateTime('revision')->after('transit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('package', function (Blueprint $table) {
            $table->dropColumn('taken');
            $table->dropColumn('transit');
            $table->dropColumn('revision');
        });
    }
}
