<?php

/**
 * Import generateChart class
 */
require_once('generateCharts.php');

class ContentAlertStatistic extends ContentElement
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_alert_statistic';
	
	/**
	 * load the dca language file
	 */
	public function __construct(Database_Result $objModule)
	{
		parent::__construct($objModule);
		
    	$this->loadLanguageFile('tl_content');
	}
	
    /**
     * Compile the current element
     */
    protected function compile()
    {
    	$charts = new generateCharts();
    	
    	/* check which statistic type is selected */
	   	switch ($this->statisticType) {
    		case $GLOBALS['TL_LANG']['tl_content']['fwm']['statsType']['year']:
    			
    			$years = (int) preg_replace('/[^0-9]/', '', $this->statisticYear);
    			
    			$this->Template->chartType = 'year';
    			$this->Template->chart = $charts->totalAlertsYear($years+1);
    		
    		break;
    		case $GLOBALS['TL_LANG']['tl_content']['fwm']['statsType']['month']:
    		
    			$years = deserialize($this->statisticYear);
    			$this->Template->chartType = 'month';
    			$this->Template->chart = $charts->totalAlertsMonthYears($years);
    		
    		break;
    		case $GLOBALS['TL_LANG']['tl_content']['fwm']['statsType']['type']:
    			
    			$this->Template->chartType = 'type';
    			$this->Template->chart = $charts->totalAlertTypes($this->statisticYear);
    		
    		break;
    	}
    	
    	$chartOptions = array('showTitle'	=> $this->chartShowTitle,
							  'width'		=> deserialize($this->chartWidth),
							  'bgColor'		=> $this->chartBg,
							  'showLegend'	=> $this->chartShowLegend,
							  'posLegend'	=> $this->chartPositionLegend,
							  'colors'		=> explode(',',$this->chartColors));
			
		if($chartOptions['width']['unit'] === 'px') $chartOptions['width']['unit'] = '';
		if($chartOptions['colors'][0] === '') $chartOptions['colors'] = '';
			
		$this->Template->chartOptions = $chartOptions;	
    }
}