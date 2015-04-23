<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwapsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('swaps', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('rkey');
			$table->string('sid');
			$table->string('requestor');
			$table->string('owner');
			$table->string('response')->default('none');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('swaps');
	}

}
