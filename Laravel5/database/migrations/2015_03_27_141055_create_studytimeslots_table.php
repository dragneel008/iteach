<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudytimeslotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('study_time_slots', function(Blueprint $table)
		{
			$table->string('studyName');
			$table->string('studySection');
			$table->string('startTime');
			$table->string('endTime');
			$table->string('day');
			$table->float('units');
			$table->string('room');
			$table->unique(array('studyName','studySection'));
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
		Schema::drop('study_time_slots');
	}

}
