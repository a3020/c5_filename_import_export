<?php 
defined('C5_EXECUTE') or die("Access Denied.");

$ch = Page::getByPath("/dashboard/files/filenames");
$chp = new Permissions($ch);
if (!$chp->canRead()) {
	die("Access Denied.");
}

set_time_limit(0);

$fileLocation = DIR_FILES_UPLOADED_STANDARD.'/incoming/filenames-import.csv';
if(file_exists($fileLocation)){
	$rFile = fopen($fileLocation, 'r');
	
	while (($line = fgetcsv($rFile)) !== FALSE) {
		if(!isset($line[0]) OR !isset($line[1])){
			continue;
		}
		
		$fID = $line[0];
		$filename = $line[1];
		
		// skip invalid fID's
		if(!ctype_digit($fID)){
			continue;
		}
		
		$file = File::getByID($fID);
		
		if(!$file){
			echo t("Skip fileID %d with name '%s'", $fID, $filename);
			continue;
		}
		
		$fv = $file->getVersion();
		
		echo t("Current file: %d with name '%s'", $fID, $filename).'.<br />';
		echo t("Path: <a target='_blank' href='%s'>%s</a>", $fv->getURL(), $file->getPath()).'<br />';
		
		if($filename == $fv->fvFilename){
			echo t("* Skipped because filenames are identical").'<br /><br />';
			continue;
		}
		
		
		
		$oldFilename = $fv->fvFilename;
		$path = str_replace($oldFilename, '', $file->getPath());
		
		if(@rename($file->getPath(), $path.$filename)){
			$fv->updateTitle($filename);
			$fv->updateFile($filename, $fv->getPrefix());
		
			echo t("* Renamed from %s to %s", $oldFilename, $fv->fvFilename).'<br />';
			echo t("* New path: <a target='_blank' href='%s'>%s</a>", $fv->getURL(), $fv->getPath()).'<br /><br />';
		} else {
			echo t("* Couldn't rename file. Check permissions.").'<br /><br />';
		}
		
	}
} else {
	die(t("File %s not found", "filenames-import.csv"));
}