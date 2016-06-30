<?php

class ModuleAlertGalleryMenu extends Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'fwm_alert_gallery_menu';
	
	
	public function __construct(Database_Result $objModule)
	{
		parent::__construct($objModule);
		$this->loadLanguageFile('fwm_alert_gallery');
	}


	
	
	
    /**
     * Compile the current element
     */
    protected function compile()
    {
    
    $time = time();
    
    $arrLinks = deserialize($this->fwm_alert_menulinks);
    
	// Get current "jumpTo" page
	$objPage = $this->Database->prepare("SELECT alias FROM tl_page WHERE id=?")
							  ->limit(1)
							  ->execute($this->jumpTo);


	foreach ($arrLinks as $id)
	{
		// Get all active items
		$objArchives = $this->Database->prepare("SELECT year FROM tl_alert_archive WHERE id=? AND (start='' OR start<$time) AND (stop='' OR stop>$time) AND published=1")
									  ->execute($id);

		while ($objArchives->next())
		{
			$arrData[$objArchives->year]['href'] = $this->generateFrontendUrl($objPage->row(),'/einsatzbilder/'.$objArchives->year);
			$arrData[$objArchives->year]['isActive'] = false;
		}
	}
	
	if($this->Input->get('einsatzbilder')){
		$activePage = $this->Input->get('einsatzbilder');
		$arrData[$activePage]['isActive'] = true;
	}
	
	$this->Template->links = $arrData;
    $this->Template->foo = $GLOBALS['TL_LANG']['fwm']['gallery']['alertImages'];
    
    }
    
    
}
?>