<?php

class ModuleAlertGalleryViewer extends Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'fwm_alertGalleryViewer';
	
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

			$objTemplate->wildcard = '### ALERT GALLERY VIEWER ###';
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
    	
    	$alertYear = $this->Input->get($alertYearURL);
    	$getAlert = $this->Input->get($alertURL);
    	
    	if($alertYear == ''){ 
	    	$alertYear = date('Y');
	    }
    	
    	$objAlertYear = $this->Database->prepare("SELECT id FROM tl_alert_archive WHERE year=?")
							  		   ->limit(1)
							  		   ->execute($alertYear);
							  
		$alertYearId = $objAlertYear->next();
		
		$this->Template->alertYear = $alertYear;
        $this->Template->galleryPreview = $this->galleryPreview($getAlert,$alertYearId->id);
               
        
        if($getAlert != ''){
        	$this->Template->galleryViewer = $this->galleryViewer($getAlert,$alertYearId->id);
        }
    }
    
    
    protected function galleryPreview($getAlert,$yearId)
    {
    	$time = time();
    	$alertURL = $GLOBALS['TL_LANG']['fwm']['misc']['alertURL'];
    	
    	
	    $objAlerts = $this->Database->prepare('SELECT s.*, a.year AS `archive`
						                       FROM tl_alert s
						                       INNER JOIN tl_alert_archive a
						                       ON a.id=s.pid
						                       WHERE s.pid=?
						                       AND a.published=?
						                       AND s.imagelink=?
						                       AND (a.start=? OR a.start<?)
						                       AND (a.stop=? OR a.stop>?)
						                       AND s.published=?
						                       AND (s.start=? OR s.start<?)
						                       AND (s.stop=? OR s.stop>?)
						                       ORDER BY s.alertNumber DESC')
						            ->execute($yearId, 1,1, '', $time, '', $time, 1, '', $time, '', $time);
         
        $alerts = $objAlerts->fetchAllAssoc();

        $galleryPreview = array();
        
        foreach($alerts as $index => $alertData)
        {
        	$galleryLink =  $alertData['alertNumber']."-".$this->parseDate('dm',$alertData['dateStart'])."-".standardize($this->restoreBasicEntities($alertData['type']));
        
        	$galleryPreview[$index] = array('alertType' 	=> $alertData['type'],
							        		'dateStart' 	=> $this->parseDate('d.m.',$alertData['dateStart']),
							        		'galleryLink' 	=> $this->addToUrl($alertURL.'='.$galleryLink),
							        		'isActive' 		=> false);
        	
        	if($getAlert == $galleryLink){
        		$galleryPreview[$index]['isActive'] = true;
        	}
        	
        	if($alertData['preview'] != ''){
        		$objFile = deserialize($alertData['previewSize']);

        		$width = !empty($objFile[0]) ? $objFile[0] : 150;
        		$height = !empty($objFile[1]) ? $objFile[1] : 150;
        		$crop = !empty($objFile[3]) ? $objFile[3] : 'proportional';


        		$galleryPreview[$index]['preview'] = array('src' 	=> $alertData['preview'],
														   'thumb' 	=> $this->getImage($alertData['preview'], $width, $height, $crop),
														   'alt' 	=> $alertData['alt'],
														   'title' 	=> $alertData['previewTitle'],
														   'width' 	=> $width,
														   'height' => $height,
														   'size' 	=> 'width="' . $width . 'px" height="' . $height . 'px"');
        	}
        }
        
        return $galleryPreview;
    }
    
    protected function galleryViewer($getAlert,$yearId) 
    {
    	$time = time();
    	
    	$galleryViewer = array();
    	
    	$alertNumber = explode("-", $getAlert);
        	
	    $objAlerts = $this->Database->prepare('SELECT s.*, a.year AS `archive`
						                       FROM tl_alert s
						                       INNER JOIN tl_alert_archive a
						                       ON a.id=s.pid
						                       WHERE s.pid=?
						                       AND a.published=?
						                       AND s.imagelink=?
						                       AND s.alertNumber=?
						                       AND (a.start=? OR a.start<?)
						                       AND (a.stop=? OR a.stop>?)
						                       AND s.published=?
						                       AND (s.start=? OR s.start<?)
						                       AND (s.stop=? OR s.stop>?)
						                       ORDER BY s.alertNumber DESC')
						            ->execute($yearId, 1,1,$alertNumber[0], '', $time, '', $time, 1, '', $time, '', $time);
         
    	$alert = $objAlerts->fetchAllAssoc();
    	
    	
    	if($alert[0]['images']){
    		$galleryViewer['dateStart'] = $alert[0]['dateStart'];
    		$galleryViewer['type'] = $alert[0]['type'];
    		$galleryViewer['location'] = $alert[0]['location'];
    		
    		$galleryViewer['files'] = $this->generateGallery(deserialize($alert[0]['images']), array(150, 150, '', 'proportional'));
    	
    		return $galleryViewer;
    	}
    }
    
    protected function generateGallery($multiSrc,$thumbSize) 
    {
    	$images = array();

		// Get all images
		foreach ($multiSrc as $file)
		{
			if (isset($images[$file]) || !file_exists(TL_ROOT . '/' . $file))
			{
				continue;
			}
			
			// Single files
			if (is_file(TL_ROOT . '/' . $file))
			{
	
				$objFile = new File($file);
				$this->parseMetaFile(dirname($file));
				$arrMeta = $this->arrMeta[$objFile->basename];
				
				if ($arrMeta[0] == '')
				{
					$arrMeta[0] = str_replace('_', ' ', preg_replace('/^[0-9]+_/', '', $objFile->filename));
				}

				if ($objFile->isGdImage)
				{
					$images[$file] = array('name' 		=> $objFile->basename,
										   'src' 		=> $file,
										   'thumb' 		=> $this->getImage($file, $thumbSize[0], $thumbSize[1], $thumbSize[3]),
										   'alt' 		=> $arrMeta[0],
										   'caption' 	=> $arrMeta[2],
										   'width' 		=> $thumbSize[0],
										   'height' 	=> $thumbSize[1],
										   'size' 		=> 'width="' . $thumbSize[0] . 'px" height="' . $thumbSize[1] . 'px"');
				}

				continue;
			}

			$subfiles = scan(TL_ROOT . '/' . $file);
			$this->parseMetaFile($file);

			// Folders
			foreach ($subfiles as $subfile)
			{
				if (is_dir(TL_ROOT . '/' . $file . '/' . $subfile))
				{
					continue;
				}

				$objFile = new File($file . '/' . $subfile);

				if ($objFile->isGdImage)
				{
					$arrMeta = $this->arrMeta[$subfile];

					if ($arrMeta[0] == '')
					{
						$arrMeta[0] = str_replace('_', ' ', preg_replace('/^[0-9]+_/', '', $objFile->filename));
					}

					$images[$file . '/' . $subfile] = array('name' 		=> $objFile->basename,
															'src' 		=> $file . '/' . $subfile,
															'thumb' 	=> $this->getImage($file . '/' . $subfile, $thumbSize[0], $thumbSize[1], $thumbSize[3]),
															'alt' 		=> $arrMeta[0],
															'caption' 	=> $arrMeta[2],
															'width' 	=> $thumbSize[0],
															'height' 	=> $thumbSize[1],
															'size' 		=> 'width="' . $thumbSize[0] . 'px" height="' . $thumbSize[1] . 'px"');
				}
			}
		}
	
		return $images;
    }  
}