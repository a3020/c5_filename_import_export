<?php 
defined('C5_EXECUTE') or die("Access Denied.");

$ch = Page::getByPath("/dashboard/brochure");
$chp = new Permissions($ch);
if (!$chp->canRead()) {
	die("Access Denied.");
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=filenames-export.csv');

$output = fopen('php://output', 'w');

fputcsv($output, array('fID', 'filename'));

Loader::model('file_list');

$fl = new FileList();
$files = $fl->get(false);

if (count($files) > 0) {
	foreach($files as $f) {
		$fv = $f->getRecentVersion();
		
		fputcsv($output, array(
			$fv->getFileID(),
			$fv->getFileName()
		));
	}
}