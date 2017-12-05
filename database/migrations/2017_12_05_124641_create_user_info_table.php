<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_info', function(Blueprint $table)
		{
			$table->bigInteger('user_info_id', true);
			$table->integer('dni')->nullable();
			$table->date('birthdate')->nullable();
			$table->enum('gender', array('NA','M','F'))->nullable();
			$table->string('city', 500)->nullable();
			$table->string('province', 500)->nullable();
			$table->string('country', 500)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_info');
	}

}
