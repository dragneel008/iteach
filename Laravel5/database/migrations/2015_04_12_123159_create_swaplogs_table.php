<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwaplogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('swaplogs', function(Blueprint $table)
		{
			$table->increments('id')->unique();
			$table->string('object1');
			$table->string('object2');
			$table->string('requestBy');
			$table->string('adminNum');
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
		Schema::drop('swaplogs');
	}

}
