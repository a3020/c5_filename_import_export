<?php
defined('C5_EXECUTE') or die("Access Denied.");

class FilenameImportExportPackage extends Package {

	protected $pkgHandle = 'filename_import_export';
	protected $appVersionRequired = '5.6.0';
	protected $pkgVersion = '0.9.1';
	
	public function getPackageDescription() {
		return t("Import and export CSV with filenames");
	}
	
	public function getPackageName() {
		return t("Filename import / export");
	}
	
	public function installEverything($pkg){
		$this->installSinglePages($pkg);
	}
	
	public function installSinglePages($pkg){
		Loader::model('single_page');
		
		if(Page::getByPath('/dashboard/files/filenames')->isError()){
			$def = SinglePage::add('/dashboard/files/filenames', $pkg);
			$def->update(array('cName' => t('Filenames')));
		}
	}
		
	public function install() {
		$pkg = parent::install();
		
		$this->installEverything($pkg);
	}
	
    public function upgrade(){
		$pkg = parent::getByHandle($this->pkgHandle);
        
		$this->installEverything($pkg);
		
		parent::upgrade();
	}
}