<?php

class ModuleAlertArchiveMenu extends Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'fwm_alertArchiveMenu';

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

			$objTemplate->wildcard = '### ALERT ARCHIVE MENU ###';
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
    
     	$time = time();
    
     	$alertYearURL = $GLOBALS['TL_LANG']['fwm']['misc']['alertYearURL'];
    
     	// Get current "jumpTo" page
		$objPage = $this->Database->prepare("SELECT alias FROM tl_page WHERE id=?")
								  ->limit(1)
								  ->execute($this->jumpTo);

		if($this->fwm_all_link)
		{
    		// Get all active items
			$objArchives = $this->Database->prepare("SELECT year FROM tl_alert_archive 
													 WHERE (start='' OR start<$time) 
													 AND (stop='' OR stop>$time) 
													 AND published=1 
													 ORDER BY year DESC")
										  ->execute();

			while ($objArchives->next())
			{
				$arrData[$objArchives->year]['href'] = $this->generateFrontendUrl($objPage->row(),'/'. $alertYearURL .'/'.$objArchives->year);
				$arrData[$objArchives->year]['isActive'] = false;
			}
		}else{
	    	$arrLinks = deserialize($this->fwm_alert_menulinks);
	    
			foreach ($arrLinks as $id)
			{
				// Get all active items
				$objArchives = $this->Database->prepare("SELECT year FROM tl_alert_archive 
														 WHERE id=? 
														 AND (start='' OR start<$time) 
														 AND (stop='' OR stop>$time) 
														 AND published=1")
											  ->execute($id);
		
				while ($objArchives->next())
				{
					$arrData[$objArchives->year]['href'] = $this->generateFrontendUrl($objPage->row(),'/' . $alertYearURL . '/'.$objArchives->year);
					$arrData[$objArchives->year]['isActive'] = false;
				}
			}
		}
	
		if($this->Input->get($alertYearURL)){
			$activePage = $this->Input->get($alertYearURL);
		}else{
			$activePage = date('Y');
		}
	
		$arrData[$activePage]['isActive'] = true;
	
		$this->Template->links = $arrData;
    }
}