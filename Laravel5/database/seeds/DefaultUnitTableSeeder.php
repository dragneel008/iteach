<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


/*
	This seeder is to seed the default units assigned for lecture undergraduate,
	lab undergraduate,undergraduate SP, undergraduate Thesis, lecture gradute,
	lab graduate.
*/
class DefaultUnitTableSeeder extends Seeder {

	public function run()
	{
		DB::table('defaultunits')->delete();				//delete whatever data is present before adding new ones
		
		DB::table('defaultunits')->insert(array(
			
			['type'=>'Lecture',
			'classification'=>'Undergraduate',
			'unitValue'=>3.0],
			
			['type'=>'Lab',
			'classification'=>'Undergraduate',
			'unitValue'=>1.5],
			
			['type'=>'Sect',
			'classification'=>'Undergraduate',
			'unitValue'=>3.0],
			
			['type'=>'Sect',
			'classification'=>'UndergraduateSP',
			'unitValue'=>3.0],
			
			['type'=>'Sect',
			'classification'=>'UndergraduateThesis',
			'unitValue'=>0.0],
			
			['type'=>'Lecture',
			'classification'=>'Graduate',
			'unitValue'=>3.0],
			
			['type'=>'Lab',
			'classification'=>'Graduate',
			'unitValue'=>2.25],
			
			['type'=>'Sect',
			'classification'=>'Graduate',
			'unitValue'=>4.5],
			
			['type'=>'Sect',
			'classification'=>'GraduateThesis',
			'unitValue'=>0.0],

		));
	}
}
