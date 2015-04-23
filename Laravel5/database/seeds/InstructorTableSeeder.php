<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
/*
	This seeds the information per instructor (first name,last name,employee id. status[
	whether active/inactive] ).
*/
class InstructorTableSeeder extends Seeder {

	 
	public function run()
	{
		DB::table('instructors')->delete();			//delete whatever data is present before adding new ones
		
		DB::table('instructors')->insert(array(
			
			['fname'=>'Ivy Joy',
			'lname'=>'Aguila',
			'employeeId'=>'101',
			'status'=>'Active'],
			
			['fname'=>'Allister Grant',
			'lname'=>'Alambra',
			'employeeId'=>'102',
			'status'=>'Inactive'],
			
			['fname'=>'Eliezer',
			'lname'=>'Albacea',
			'employeeId'=>'103',
			'status'=>'Active'],
			
			['fname'=>'Zenith',
			'lname'=>'Arneho',
			'employeeId'=>'104',
			'status'=>'Active'],
			
			['fname'=>'Kristine Elaine',
			'lname'=>'Bautista',
			'employeeId'=>'105',
			'status'=>'Active'],
			
			['fname'=>'Juan Miguel',
			'lname'=>'Bawagan III',
			'employeeId'=>'106',
			'status'=>'Active'],
			
			['fname'=>'Sheila Kathleen',
			'lname'=>'Borja',
			'employeeId'=>'107',
			'status'=>'Inactive'],
			
			['fname'=>'Rommel',
			'lname'=>'Bulalacao',
			'employeeId'=>'108',
			'status'=>'Active'],
			
			['fname'=>'Francisco Enrique Vicente',
			'lname'=>'Castro',
			'employeeId'=>'109',
			'status'=>'Inactive'],
			
			['fname'=>'Maria Art Antonette',
			'lname'=>'Clarino',
			'employeeId'=>'110',
			'status'=>'Inactive'],
			
			['fname'=>'Lailanie',
			'lname'=>'Danila',
			'employeeId'=>'111',
			'status'=>'Active'],
			
			['fname'=>'Marie Yvette',
			'lname'=>'De Robles',
			'employeeId'=>'112',
			'status'=>'Active'],
			
			['fname'=>'John Emmanuel',
			'lname'=>'Encinas',
			'employeeId'=>'113',
			'status'=>'Active'],
			
			['fname'=>'Ailea Kathleen',
			'lname'=>'Garcera',
			'employeeId'=>'114',
			'status'=>'Active'],
			
			['fname'=>'Joseph Anthony',
			'lname'=>'Hermocilla',
			'employeeId'=>'115',
			'status'=>'Active'],
			
			['fname'=>'Arian',
			'lname'=>'Jacildo',
			'employeeId'=>'116',
			'status'=>'Active'],
			
			['fname'=>'Conception',
			'lname'=>'Khan',
			'employeeId'=>'117',
			'status'=>'Active'],
			
			['fname'=>'Lei Kristoffer',
			'lname'=>'Lactuan',
			'employeeId'=>'118',
			'status'=>'Active'],
			
			['fname'=>'Fermin Roberto',
			'lname'=>'Lapitan',
			'employeeId'=>'119',
			'status'=>'Active'],
			
			['fname'=>'Christian John',
			'lname'=>'Lo',
			'employeeId'=>'120',
			'status'=>'Inactive'],
			
			['fname'=>'Val Randolf',
			'lname'=>'Madrid',
			'employeeId'=>'121',
			'status'=>'Active'],
			
			['fname'=>'Katrina Joy',
			'lname'=>'Magno',
			'employeeId'=>'122',
			'status'=>'Active'],
			
			['fname'=>'Martee Aaron',
			'lname'=>'Manalang',
			'employeeId'=>'123',
			'status'=>'Active'],
			
			['fname'=>'Vladimir',
			'lname'=>'Mariano',
			'employeeId'=>'124',
			'status'=>'Inactive'],
			
			['fname'=>'Danilo',
			'lname'=>'Mercado',
			'employeeId'=>'125',
			'status'=>'Active'],
			
			['fname'=>'Rizza',
			'lname'=>'Mercado',
			'employeeId'=>'126',
			'status'=>'Active'],
			
			['fname'=>'Tino-Jan Keith',
			'lname'=>'Monserrat',
			'employeeId'=>'127',
			'status'=>'Active'],
			
			['fname'=>'Rick Jason',
			'lname'=>'Obrero',
			'employeeId'=>'128',
			'status'=>'Active'],
			
			['fname'=>'Jaderick',
			'lname'=>'Pabico',
			'employeeId'=>'129',
			'status'=>'Active'],
			
			['fname'=>'Margarita Carmen',
			'lname'=>'Paterno',
			'employeeId'=>'130',
			'status'=>'Active'],
			
			['fname'=>'Caroline Natalie',
			'lname'=>'Peralta',
			'employeeId'=>'131',
			'status'=>'Active'],
			
			['fname'=>'James Carlo',
			'lname'=>'Plaras',
			'employeeId'=>'132',
			'status'=>'Active'],
			
			['fname'=>'Joe Ramir',
			'lname'=>'Ramirez',
			'employeeId'=>'133',
			'status'=>'Active'],
			
			['fname'=>'Reginald Neil',
			'lname'=>'Recario',
			'employeeId'=>'134',
			'status'=>'Active'],
			
			['fname'=>'Mark Harold',
			'lname'=>'Rivera',
			'employeeId'=>'135',
			'status'=>'Active'],
			
			['fname'=>'Jaime',
			'lname'=>'Samaniego',
			'employeeId'=>'136',
			'status'=>'Active'],
			
			['fname'=>'Mark Froilan',
			'lname'=>'Tandoc',
			'employeeId'=>'137',
			'status'=>'Active'],
			
			['fname'=>'Ludwig Johann',
			'lname'=>'Tirazona',
			'employeeId'=>'138',
			'status'=>'Active'],
			
			['fname'=>'Gianina Renee',
			'lname'=>'Vergara',
			'employeeId'=>'139',
			'status'=>'Inactive'],
			
			['fname'=>'Marie Betel',
			'lname'=>'De Robles',
			'employeeId'=>'140',
			'status'=>'Active'],
			
			['fname'=>'Miyah',
			'lname'=>'Queliste',
			'employeeId'=>'141',
			'status'=>'Active'],
		));
	
	DB::table('instructors')->where('employeeId', '105')
		->update(['registered' => true]);

	}
}
