<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AddDissolveSectionLogs extends Model {

	//
	protected $fillable = ['logId', 'courseNum', 'sectionNum', 'adminNum', 'action'];
	protected $table = 'add_dissolve_section_logs';
}
