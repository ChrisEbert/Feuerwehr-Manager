<?php

/**
 * Import generateChart class
 */ 
require('generateCharts.php');

class BeModuleAlertStatisticYear extends BackendModule{
  
  	/**
	 * Compile the backend module
	 */
    public function compile() 
    { 
		$objTemplate = new BackendTemplate('be_alert_statistic_year');
		
		/* get archive ID */
		$yearId = $this->Input->get('id');
		
		$objArchive = $this->Database->prepare("SELECT year FROM tl_alert_archive WHERE id=?")
					  				 ->execute($yearId);
					  
		$objArchive  = $objArchive->next();
		
		$charts = new generateCharts();
		 
		$objTemplate->totalAlertsMonth = $charts->totalAlertsMonth($yearId);
		$objTemplate->totalAlertTypes = $charts->totalAlertTypes($yearId);
		
		$objTemplate->headline = sprintf($GLOBALS['TL_LANG']['fwm']['statistic']['headlineYear'],$objArchive->year);
		
		$objTemplate->backHref = $this->getReferer(true);
		$objTemplate->backTitle = specialchars($GLOBALS['TL_LANG']['MSC']['backBT']);
		$objTemplate->backButton = $GLOBALS['TL_LANG']['MSC']['backBT'];
		
		return $objTemplate->parse();
	}   
}