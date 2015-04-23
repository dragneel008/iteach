<?php namespace App\Http\Controllers\ITEACH;

use App\Http\Controllers\Controller;
use Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use DB;
use Validator;
use App\Course;
use App\Section;

Class AdminParserController extends Controller {

	public function index() 
	{
		return view('iteach.admin.uploadCSVFile');
	}

	public function processCSV(){
		 
		$file = Request::file('inputFile');							//get the file as a .tmp -->like a hashed fileName
		$trueFileName = $file->getClientOriginalName();				//get the true file name, not the .tmp file 
		
		$extension = File::extension($trueFileName);
		
		if ($extension == 'csv'){	//to validate if the file being uploaded is a .csv file.
			$fileName = $file->getFilename().'.'.$trueFileName;			//create string with the name of the file plus its extension
			Storage::disk('local')->put( $fileName, File::get($file));	//store into storage/app
			$contents = Storage::get($fileName);						//read the contents of the uploaded file	
			
			$i = 0;
			$flag = 0;
			$tok = strtok($contents,",");
			while($tok !== false){		

				switch($flag){				//this switch is for controlling the distribution of data in tokenizing the line
					case 0:
						$day[$i] = $tok;
						$flag = 1;
						break;
					case 1:
						$type[$i] = $tok;
						$flag=2;
						break;
					case 2:
						$course_num[$i] = $tok;
						$flag = 3;
						break;
					case 3:
						$section[$i] = $tok;
						$flag = 4;
						break;
					case 4:
						$start_time[$i] = $tok;
						$flag = 5;
						break;
					case 5:
						$end_time[$i] = $tok;
						$flag = 6;
						break;
					case 6:
						$room[$i] = $tok;
						$flag = 7;
						break;
					case 7:
						$faculty[$i] = $tok;
						$flag = 8;
						break;
					case 8:
						$splitted = preg_split('#\s+#',$tok,null,PREG_SPLIT_NO_EMPTY);
						$class_size[$i] = $splitted[0];
						if(count($splitted)!=1){
							$i++;
							$day[$i] = $splitted[1];
							$flag = 1;
						}
						break;
				}
				$tok = strtok(",");
			}
			
			$counter = count($course_num);

			for($i=1;$i<$counter;$i++){
				 $results = Section::compositeKey($course_num[$i], $section[$i])->get();
				 if(COUNT($results) == 0){
					 $addDb = new Section;
					 $addDb->type = $type[$i];
					 $addDb->courseNum = $course_num[$i];
					 $addDb->sectionNum = $section[$i];
					 $addDb->day = $day[$i];
					 $addDb->startTime = $start_time[$i];
				 	 $addDb->endTime = $end_time[$i];
					 $addDb->roomNum = $room[$i];
					 $addDb->employeeId = $faculty[$i];
					 $addDb->classSize = $class_size[$i];
					 //the assignment of teaching units per course
						$class_subj = Course::where('courseNum','like',$course_num[$i])->get()->first();
						
						if(isset($class_subj)){
							if($type[$i] == "Lecture"){
								if($class_subj->classification == 'Undergraduate')
									$addDb->teachingUnits = 3.0;	//insert computation
								else if($class_subj->classification == 'Graduate')
									$addDb->teachingUnits = 3.0;
							}
							else if($type[$i] == "Lab"){
								if($class_subj->classification == 'Undergraduate')
									$addDb->teachingUnits = 1.5;
								else if($class_subj->classification == 'Graduate')
									$addDb->teachingUnits = 2.25;
							}
							else if($type[$i] == "Sect"){
								if($class_subj->classification == 'UndergraduateSP')
									$addDb->teachingUnits = 3.0;	//insert computation
								else if($class_subj->classification == 'Graduate')
									$addDb->teachingUnits = 4.5;
								else if($class_subj->classification == 'UndergraduateThesis' || $class_subj == 'GraduateThesis')
									$addDb->teachingUnits = 0.0;						

							}
						}

					 $addDb->save();
				 }
		
			}
			//$data can now be passed on to model and be stored in db.
			$data['type'] = $type;
			$data['course_num'] = $course_num;
			$data['section'] = $section;
			$data['day'] = $day;
			$data['start_time'] = $start_time;
			$data['end_time'] = $end_time;
			$data['room'] = $room;
			$data['faculty'] = $faculty;
			$data['class_size'] = $class_size;
			
			return view("iteach.admin.successfulUpload",$data);		//add a second parameter here to pass the data to the view.
		}
		else{
			$data['fileName'] = $trueFileName;
			return view("iteach.admin.failUpload",$data);
		}
	}

}
