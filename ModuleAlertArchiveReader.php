<?php

class ModuleAlertArchiveReader extends Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'fwm_alertArchiveReader';
	
	public function __construct(Database_Result $objModule)
	{
		parent::__construct($objModule);
		
    	$this->loadLanguageFile('fwm_alert_misc');
	} 

public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ALERT ARCHIVE READER ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}
	
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
     	$alertURL = $GLOBALS['TL_LANG']['fwm']['misc']['alertURL'];
    
     	$activePage = $this->Input->get($alertYearURL);
    
	    if($activePage == ''){ 
	    	$activePage = date('Y');
	    }

    
	    $objId = $this->Database->prepare("SELECT id,galleryPage FROM tl_alert_archive WHERE year=?")
							  	->limit(1)
							  	->execute($activePage);
							  
		$objActivePage = $objId->next();
    
		$galleryPage = $this->Database->prepare("SELECT alias FROM tl_page WHERE id=?")
								  	  ->limit(1)
								  	  ->execute($objActivePage->galleryPage);
    	
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
						            ->execute($objActivePage->id, 1, '', $time, '', $time, 1, '', $time, '', $time);
         
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