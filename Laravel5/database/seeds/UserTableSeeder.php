<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/***
	This is the seeder for the users' credentials that will be used for the login.
	This contains the type(admin/faculty),username,employeeId,and password.
***/
class UserTableSeeder extends Seeder {

	 
	public function run()
	{
		DB::table('users')->delete();			//delete whatever data is present before adding new ones

		DB::table('users')->insert(array(
			
			['type'=>'admin',
			'username'=>'Gani',
			'employeeId'=>'0987654321',
			'password'=> bcrypt('masterGani')],
			
			['type'=>'faculty',
			'username'=>'CJ',
			'employeeId'=>'1234567890',
			'password'=> bcrypt('masterCJ')],
			
			['type'=>'admin',
			'username'=>'kepbautista',
			'employeeId'=>'105',
			'password'=> bcrypt('kepbautista')],
			
			['type'=>'faculty',
			'username'=>'mbbderobles',
			'employeeId'=>'140',
			'password'=> bcrypt('mbbderobles')],

		));
	}
}
