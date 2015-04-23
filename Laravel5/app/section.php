<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model {

	protected $fillable = ['sectionNum', 'courseNum', 'employeeId', 'startTime', 'endTime', 'day', 'classSize', 'roomNum'];
	protected $table = 'sections';
	public function scopeCompositeKey($query, $course_num, $section){
		return $query -> where('courseNum', 'like', $course_num) -> where('sectionNum', 'like', $section);
	}

}
