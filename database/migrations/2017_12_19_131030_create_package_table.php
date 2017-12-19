<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('package', function(Blueprint $table)
		{
			$table->bigInteger('package_id', true);
			$table->bigInteger('user_id')->default(0);
			$table->string('origin', 50);
			$table->char('destination', 2);
			$table->integer('service_id');
			$table->string('tracking', 50);
			$table->string('title', 50);
			$table->text('description', 65535);
			$table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('delivery');
			$table->enum('auction', array('N','Y'))->default('N');
			$table->decimal('price', 10, 0)->nullable();
			$table->char('status', 1)->default(0)->comment('0=libre, 1=tomado, 2=revision, 3=entregado');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('package');
	}

}
