<?php

class generateCharts extends Backend{


	/**
	 * load language file for statistics
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->loadLanguageFile('fwm_alert_statistic');
	}  

	/**
	 * helper function to get alert archive/s
	 */
 	protected function getAlertArchive($year = '', $limit = 0)
 	{
    	$time =time();
    	
    	if(empty($year))
    	{
			$objArchives = $this->Database->prepare("SELECT year,id FROM tl_alert_archive 
													 WHERE (start='' OR start<$time) 
													 AND (stop='' OR stop>$time) 
													 AND published=1 
													 ORDER BY year DESC")
									  	  ->limit($limit)
									  	  ->execute();
    	}else{
			$objArchives = $this->Database->prepare("SELECT year,id FROM tl_alert_archive 
													 WHERE id=? 
													 AND (start='' OR start<$time) 
													 AND (stop='' OR stop>$time) 
													 AND published=1")
										  ->execute($year);
    	}
    	
    	return $objArchives->fetchAllAssoc();
    }
    
    /**
     * helper function to get alerts from an archive
     */
    protected function getAlerts($archiveId,$sorting = 'alertNumber DESC',$value = '*')
    {	
    	$time = time();
        $objAlerts = $this->Database->prepare('SELECT s.' . $value . ', a.year AS `archive`
						                       FROM tl_alert s
						                       INNER JOIN tl_alert_archive a
						                       ON a.id=s.pid
						                       WHERE s.pid=?
						                       AND s.published=?
						                       AND (s.start=? OR s.start<?)
						                       AND (s.stop=? OR s.stop>?)
						                       ORDER BY s.' . $sorting)
						            ->execute($archiveId, 1, '', $time, '', $time);
            
		return $objAlerts->fetchAllAssoc();
    }
    
    public function totalAlertsYear($limit = 0)
    {
    	$archives = $this->getAlertArchive('',$limit);
    	
    	unset($archives[0]);
    
    	$totalAlerts = array();
    	
	    $totalAlerts['title'] = $GLOBALS['TL_LANG']['fwm']['statistic']['totalAlertsYearTitle'];
    	
    	$totalAlerts['dataHead'] = "['"
    							 . $GLOBALS['TL_LANG']['fwm']['statistic']['year'] 
    							 . "','"
    							 . $GLOBALS['TL_LANG']['fwm']['statistic']['alerts']
    							 . "']";
    	
    	foreach($archives as $archive)
    	{
    		$objAlerts = $this->getAlerts($archive['id']);
            
    		$totalAlerts['data'][$archive['year']] = count($objAlerts);
    	}
    	
    	return $totalAlerts;
    }
   
    public function totalAlertsMonth($year)
    {
	    $month = array();
   		
   		$month['title'] = $GLOBALS['TL_LANG']['fwm']['statistic']['totalAlertsMonthTitle'];
   		
   		$month['dataHead'] = "['"
   						   . $GLOBALS['TL_LANG']['fwm']['statistic']['month']
   						   . "','"
   						   . $GLOBALS['TL_LANG']['fwm']['statistic']['alerts']
   						   . "']";
   		
   		for($i=0;$i<=11;$i++)
   		{
   			$month['data'][$GLOBALS['TL_LANG']['MONTHS_SHORT'][$i]] = 0;
   		}
   		
   		$objAlerts = $this->getAlerts($year,'dateStart');
   		
   		$alertsCount = 0;
   		$lastMonth = $this->parseDate('M',$objAlerts[0]['dateStart']);
   		$totalAlerts = count($objAlerts);
   		$i=0;
   		
   		foreach($objAlerts as $alert)
   		{
   			$i++;
   			$parsedMonth = $this->parseDate("M",$alert['dateStart']);
   			
   			if($parsedMonth == $lastMonth)
   			{
   				$alertsCount++;
   			}else{
   				$month['data'][$lastMonth] = $alertsCount;
   				$alertsCount = 1;
   				$lastMonth = $parsedMonth;
   			} 
   			
   			if($i == $totalAlerts){
   				$month['data'][$parsedMonth] = $alertsCount;
   			}
   		}
   		
   		return $month;
   	}
   
   	public function totalAlertTypes($year)
   	{
   		$objAlerts = $this->getAlerts($year,'type','type');
   		
   		$alertTypes = array();
   		$alertTypesCount = array();
   		
   		foreach($objAlerts as $alert)
   		{
   			$alertTypes[] = $alert['type'];
   		}
   		
   		$alertTypesCount['title'] = $GLOBALS['TL_LANG']['fwm']['statistic']['totalAlertTypesTitle'];
   		
   		$alertTypesCount['dataHead'] = "['"
   									 . $GLOBALS['TL_LANG']['fwm']['statistic']['alertType']
   									 . "','"
   									 . $GLOBALS['TL_LANG']['fwm']['statistic']['amount']
   									 . "']";
   		
   		$alertTypesCount['data'] = array_count_values($alertTypes);
   		
   		return $alertTypesCount;
   	}


	public function totalAlertsMonthYears($years)
	{
		foreach ($years as $year) 
		{
			$archiveDetails = $this->getAlertArchive($year);
			$objYears[] = $archiveDetails[0];
		}

		$langMonth = $GLOBALS['TL_LANG']['MONTHS_SHORT'];
		
		$alertYears = array();
		
		$monthValues = array();
		
		$monthValues['title'] = $GLOBALS['TL_LANG']['fwm']['statistic']['totalAlertsMonthTitle'];
		$monthValues['dataHead'] = $GLOBALS['TL_LANG']['fwm']['statistic']['month'];
		
		foreach($objYears as $year)
		{	
			$strYear = $year['year'];
			$id = $year['id'];
			 
			$alertsCount = $this->totalAlertsMonth($id);
			
			$alertYears[$strYear] = $alertsCount['data'];  
		}
		
		foreach($langMonth as $monthName)
		{
			foreach($alertYears as $year=>$month)
			{
				foreach($month as $indexMonth=>$alerts)
				{
					if($monthName == $indexMonth)
					{
						$monthValues['data'][$monthName][$year] = $alerts;
					}
				}
			}
		}
	
		return $monthValues;
	}
}