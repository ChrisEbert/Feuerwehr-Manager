<?php 

/**
 * Import generateChart class
 */
require('generateCharts.php');

class BeModuleAlertStatisticTotal extends BackendModule{

	/**
	 * Compile the backend module
	 */
    public function compile() 
    { 
		$objTemplate = new BackendTemplate('be_alert_statistic_total');

		$objArchives = $this->Database->prepare("SELECT id FROM tl_alert_archive ORDER BY year")
									  ->execute();
		
		$archives = $objArchives->fetchAllAssoc();
		
		$charts = new generateCharts();
		
		$objTemplate->totalAlertsYears = $charts->totalAlertsYear();
		$objTemplate->totalAlertsMonthYears = $charts->totalAlertsMonthYears($archives);
		
		$objTemplate->headline = $GLOBALS['TL_LANG']['fwm']['statistic']['headlineYears'];
		
		$objTemplate->backHref = $this->getReferer(true);
		$objTemplate->backTitle = specialchars($GLOBALS['TL_LANG']['MSC']['backBT']);
		$objTemplate->backButton = $GLOBALS['TL_LANG']['MSC']['backBT'];
		
		return $objTemplate->parse();
	}   
}