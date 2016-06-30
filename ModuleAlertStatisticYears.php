<?php

require_once('generateCharts.php');

class ModuleAlertStatisticYears extends Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'fwm_alertStatisticYears';

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
    	
    	$years = deserialize($this->fwm_alert_menulinks);
    	
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
		$this->Template->totalAlertsMonthYears = $charts->totalAlertsMonthYears($years);
    }
}