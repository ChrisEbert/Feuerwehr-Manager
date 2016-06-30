<?php

class ModuleAlertArchive extends Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'fwm_alertArchive';

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
    
        $time = time();

        $objAlerts = $this->Database->prepare('SELECT s.*, a.year AS `archive`
						                       FROM tl_alert s
						                       INNER JOIN tl_alert_archive a
						                       ON a.id=s.pid
						                       WHERE s.pid=?
						                       AND a.published=?
						                       AND (a.start=? OR a.start<?)
						                       AND (a.stop=? OR a.stop>?)
						                       AND s.published=?
						                       AND (s.start=? OR s.start<?)
						                       AND (s.stop=? OR s.stop>?)
						                       ORDER BY s.alertNumber DESC')
						            ->execute($this->fwm_alert_archives, 1, '', $time, '', $time, 1, '', $time, '', $time);
         
        $alerts = $objAlerts->fetchAllAssoc();
        
        global $objPage;
        
        foreach($alerts as $index=>$alert)
        {
        	$alerts[$index]['dayStart'] 	= $this->parseDate($objPage->dateFormat, $alerts[$index]['dateStart']);
	        $alerts[$index]['dayEnd'] 		= $this->parseDate($objPage->dateFormat, $alerts[$index]['dateEnd']);  
		    $alerts[$index]['weekdayStart'] = $this->parseDate('l', $alerts[$index]['dateStart']);
	        $alerts[$index]['weekdayEnd'] 	= $this->parseDate('l', $alerts[$index]['dateEnd']);
		    $alerts[$index]['timeStart'] 	= $this->parseDate($objPage->timeFormat, $alerts[$index]['dateStart']);
	        $alerts[$index]['timeEnd'] 		= $this->parseDate($objPage->timeFormat, $alerts[$index]['dateEnd']);
	        $alerts[$index]['datetime'] 	= $this->parseDate('Y-m-d\TH:i:sP', $alerts[$index]['dateEnd']);
	        
	        if($alerts[$index]['dayStart'] !== $alerts[$index]['dayEnd'] && $alerts[$index]['dayEnd'] !== '')
	        {
		        $alerts[$index]['multipleDays'] = true;
	        }
	        
	        if($alerts[$index]['preview'])
	        {
		        $alerts[$index]['previewSize'] = deserialize($alerts[$index]['previewSize']);
		        $alerts[$index]['previewImage'] = $this->generateImage($this->getImage($alerts[$index]['preview'],$alerts[$index]['previewSize'][0],$alerts[$index]['previewSize'][1],$alerts[$index]['previewSize'][3]),$alerts[$index]['alt']);
		        $alerts[$index]['galleryLink'] = $this->generateFrontendUrl($galleryPage->row(),'/'. $alertYearURL .'/'.$activePage.'/'.$alertURL.'/'.$alerts[$index]['alertNumber']."-".$this->parseDate('dm',$alerts[$index]['dateStart'])."-".standardize($this->restoreBasicEntities($alerts[$index]['type'])));
	        }    	        
        }
        
        $this->Template->alerts = $alerts;
    }
}