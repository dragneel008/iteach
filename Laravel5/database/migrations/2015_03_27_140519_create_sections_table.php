<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sections', function(Blueprint $table)
		{
			$table->string('sid')->unique();
			$table->string('type');
			$table->string('courseNum');
			$table->string('sectionNum');
			$table->string('startTime');
			$table->string('endTime');
			$table->string('day');
			$table->string('roomNum');
			$table->string('employeeId');
			$table->string('classSize');
			$table->float('teachingUnits');
			$table->unique(['courseNum','sectionNum']);
			$table->rememberToken();
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
		Schema::drop('sections');
	}

}
