<?php namespace Modules\Students\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class StudentsController extends Controller {
	
	public function index()
	{
		return view('students::index');
	}
	
}