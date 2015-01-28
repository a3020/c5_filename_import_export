<?php  
defined('C5_EXECUTE') or die("Access Denied.");

class DashboardBrochureController extends Controller {

	public function __construct() { 
		$this->redirect('/dashboard/brochure/list/');
	}	
}