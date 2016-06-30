<?php

require_once('generateCharts.php');

class ModuleAlertStatisticReader extends Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'fwm_alertStatisticReader';

    /**
     * Compile the current element
     */
    protected function compile()
    {
    	if (($this->fwm_template != $this->strTemplate) && ($this->fwm_template != '')) 
    	{
        	$this->strTemplate = $this->fwm_template;
        	$this->Template = new FrontendTemplate($this->strTemplate);
     	}
    
    	
    	$alertYearURL = $GLOBALS['TL_LANG']['fwm']['misc']['alertYearURL'];
    
    	$alertYear = $this->Input->get($alertYearURL);
    	
    	if($alertYear == ''){ 
	    	$alertYear = date('Y');
	    }
	    
	    $objAlertYear = $this->Database->prepare("SELECT id FROM tl_alert_archive WHERE year=?")
							  		   ->limit(1)
							  		   ->execute($alertYear);
							  
		$alertYearId = $objAlertYear->next();
		
		$chartOptions = array('showTitle'=>$this->fwm_chartShowTitle,
							  'width'=>deserialize($this->fwm_chartWidth),
							  'bgColor'=>$this->fwm_chartBg,
							  'showLegend'=>$this->fwm_chartShowLegend,
							  'posLegend'=>$this->fwm_chartPositionLegend,
							  'colors'=>explode(',',$this->fwm_chartColors));
		
		if($chartOptions['width']['unit'] === 'px') $chartOptions['width']['unit'] = '';
		if($chartOptions['colors'][0] === '') $chartOptions['colors'] = '';
		
		$charts = new generateCharts(); 
		
		$this->Template->chartOptions = $chartOptions;
  		$this->Template->totalAlertsMonth = $charts->totalAlertsMonth($alertYearId->id);
  		$this->Template->totalAlertTypes = $charts->totalAlertTypes($alertYearId->id);
    }
}