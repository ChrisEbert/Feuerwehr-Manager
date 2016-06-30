<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');


require_once('generateCharts.php');


class ModuleAlertStatisticTotal extends BackendModule{


	
    
    public function compile() 
    { 
    
    	if (TL_MODE == 'BE') {
    	
    	
    	      		$objTemplate = new BackendTemplate('be_alert_statistic_total');
      		
    		
    		$charts = new generateCharts();
    	
    	
      		$objTemplate->totalAlertsYears = $charts->totalAlertsYear();
      		$objTemplate->totalAlertsMonthYears = $charts->totalAlertsMonthYears();
      		
      		return $objTemplate->parse();
      		
      	}
      
  
// generate() von der Oberklasse (BackendModule) aufrufen
		return parent::generate();
    }   
    
      
   	
}
?>