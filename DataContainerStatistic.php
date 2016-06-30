<?php

class DataContainerStatistic extends Backend
{

	/**
	 * checks statistic type and returns formatted archive names
	 * @param DataContainer
	 * @return Array
	 */
    public function getStatisticYears(DataContainer $dc)
    {	
       	$time = time();
    
		$objArchives = $this->Database->prepare("SELECT id,year 
												 FROM tl_alert_archive 
												 WHERE (start='' OR start<$time) 
												 AND (stop='' OR stop>$time) 
												 AND published=1 
												 ORDER BY year ")
									  ->execute();
	
    	$objArchive = $objArchives->fetchAllAssoc();
    	
    	if($GLOBALS['TL_LANG']['tl_content']['fwm']['statsType']['year'] === $dc->activeRecord->statisticType){
    		$yearsCount = count($objArchive);
    		
    		$i = 2;
    		while($i < $yearsCount){
    			$yearOpts[] = sprintf($GLOBALS['TL_LANG']['tl_content']['fwm']['statsYear'],$i);
    			$i++;
    		}
    	}else{
    		$objArchive = $objArchives->fetchAllAssoc();
    	
    		foreach($objArchive as $option)
    		{
    			$yearOpts[$option['id']] = $option['year'];
    		}
    	}	
     
        return $yearOpts;
    }
    
    /**
     * returns statistic types, defined in the language file
     * @return array
     */
    public function statisticTypes()
    {
    	$opts = array();
    	
    	foreach($GLOBALS['TL_LANG']['tl_content']['fwm']['statsType'] as  $option=>$value)
    	{
    		$opts[] = $GLOBALS['TL_LANG']['tl_content']['fwm']['statsType'][$option];
    	}
    	
    	return $opts;
    }
    
    /**
     * changes multiple to true of the statistic archives in special cases, returns the selected value 
     * @param string
     * @return string
     */
    public function toggleMultiple($value, DataContainer $dc)
    {
    	if($GLOBALS['TL_LANG']['tl_content']['fwm']['statsType']['month'] === $dc->activeRecord->statisticType){
    		$GLOBALS['TL_DCA']['tl_content']['fields']['statisticYear']['eval']['multiple'] = true;
    		
    	}
    	
    	return $value;
    }
}