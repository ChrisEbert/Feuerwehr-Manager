<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');


require_once('generateCharts.php');


class ModuleAlertStatisticYear extends BackendModule{
  
	  
  
    public function compile() 
    { 
    
    	if (TL_MODE == 'BE') {
      
      

      
      		$objTemplate = new BackendTemplate('be_alert_statistic_year');
      		
      		
    		$yearId = $this->Input->get('id');
    		
    		$charts = new generateCharts(); 
      		$objTemplate->totalAlertsMonth = $charts->totalAlertsMonth($yearId);
      		$objTemplate->totalAlertTypes = $charts->totalAlertTypes($yearId);
      		
      		return $objTemplate->parse();
      		
      	}
      
  
// generate() von der Oberklasse (BackendModule) aufrufen
		return parent::generate();
    }   
    
      
   	
}
?>