<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWithdrawTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('withdraw', function(Blueprint $table)
		{
			$table->bigInteger('withdraw_id', true);
			$table->bigInteger('user_id');
			$table->bigInteger('package_id');
			$table->string('amount', 10);
			$table->string('email', 100);
			$table->integer('status');
			$table->timestamp('requested')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('withdraw');
	}

}
