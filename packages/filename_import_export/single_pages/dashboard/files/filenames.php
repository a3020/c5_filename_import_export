<?php 
defined('C5_EXECUTE') or die("Access Denied.");

$ih  = Loader::helper('concrete/interface');
$url = Loader::helper('concrete/urls');

echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t("Filename import / export"), false, false, false); 
?>

<div class="ccm-pane-options">
	
</div>

<div class="ccm-pane-body">
	<?php echo t("This will generate a CSV-file with the fileID's and filenames.") ?><br />
	<a style="margin-top: 10px;" class="btn" href="<?php echo $url->getToolsURL('export', 'filename_import_export'); ?>"><?php echo t("Export filenames") ?></a>
	
	<br />
	
	<hr />
	<?php echo t("Make a backup before importing the CSV file!") ?><br />
	<?php echo t("The import script will try to import a file from this location: %s/filenames_import.csv.", REL_DIR_FILES_UPLOADED) ?><br />
	<a style="margin-top: 10px;" class="btn" href="<?php echo $url->getToolsURL('import', 'filename_import_export'); ?>"><?php echo t("Import filenames") ?></a
</div>


<?php
echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false);