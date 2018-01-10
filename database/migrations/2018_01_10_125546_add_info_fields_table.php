<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInfoFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('dni')->nullable();
    		$table->date('birthdate')->nullable();
    		$table->enum('gender', ['NA', 'F', 'M'])->nullable();
    		$table->string('city')->nullable();
    		$table->string('province')->nullable();
            $table->integer('country')->nullable();
            $table->string('ipAddress')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('dni');
    		$table->dropColumn('birthdate');
    		$table->dropColumn('gender');
    		$table->dropColumn('city');
    		$table->dropColumn('province');
            $table->dropColumn('country');
            $table->dropColumn('ipAddress');
        });
    }
}
