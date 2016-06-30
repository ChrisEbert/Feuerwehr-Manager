<?php 

/**
 * Table tl_alert
 */
$GLOBALS['TL_DCA']['tl_alert'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_alert_archive',
		'enableVersioning'            => true,
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('alertNumber DESC'),
			'headerFields'            => array('year','published'),
			'panelLayout'             => 'sort,filter;search,limit',
			'disableGrouping'		  => true,
			'child_record_callback'   => array('tl_alert', 'listalert')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_alert']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_alert']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_alert']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_alert']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_alert', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_alert']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('imagelink'),
		'default'                     => '{title_legend},type,alias,alertNumber;{date_legend},dateStart,dateEnd;{info_legend},location,latlng,map,description;{images_legend:hide},imagelink;{publish_legend},published,start,stop'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'imagelink' => 'preview,previewCaption,alt,previewTitle,previewSize,images'
	),

	// Fields
	'fields' => array
	(
		'type' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['type'],
			'search'                  => true,
			'filter'				  => true,
			'inputType'               => 'select',
			'options'				  => $GLOBALS['TL_LANG']['tl_alert']['alertTypes'],
			'eval'                    => array('mandatory'=>true, 'tl_class' => 'w50')
		),
		'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['alias'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'alnum', 'unique'=>true, 'spaceToUnderscore'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'save_callback' => array
			(
				array('tl_alert', 'generateAlias')
			)
		),
		'alertNumber' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['alertNumber'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit','doNotCopy'=>true,'tl_class'=>'w50','alwaysSave'=>true,'mandatory'=>true),
			'load_callback' => array
			(
				array('tl_alert', 'load_callback_alertNumber')
			)
			
		),
		'dateStart' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['dateStart'],
			'serch'					  => true,
			'sorting'				  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date','mandatory'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard')
		),
		'dateEnd' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['dateEnd'],
			'serch'					  => true,
			'sorting'				  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 wizard')
		),
		'imagelink' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['imagelink'],
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true)
		),
		'preview' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['preview'],
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true)
		),
		'alt' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['alt'],
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255,'tl_class'=>'w50')
		),
		'previewTitle' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['previewTitle'],
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class' => 'w50')
		),
		'previewCaption' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['previewCaption'],
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class' => 'long')
		),
		'previewSize' => array
		(
			'label' 				  => &$GLOBALS['TL_LANG']['tl_alert']['previewSize'],
			'inputType' 			  => 'imageSize',
			'options' 				  => $GLOBALS['TL_CROP'],
			'reference' 			  => &$GLOBALS['TL_LANG']['MSC'],
			'eval' 					  => array('rgxp'=>'digit', 'nospace'=>true,'helpwizard'=>true,'tl_class'=>'clr')
		),
		'images' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['images'],
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'checkbox', 'files'=>true,'mandatory'=>true,)
		),
		'location' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['location'],
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255)
		),
        'latlng' => array
            (
            'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['latlng'],
            'inputType'               => 'text',
            'eval'                    => array()
        ),
        'map' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['map'],
            'inputType'               => 'searchMap'
        ),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['description'],
			'inputType'               => 'textarea',
			'eval'					  => array('rte'=>'tinyMCE')
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true)
		),
		'start' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['start'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard')
		),
		'stop' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert']['stop'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard')
		)
	)
);


/**
 * Class tl_alert
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_alert extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	/**
	 * Auto-generate the alert alias if it has not been set yet
	 * @param mixed
	 * @param DataContainer
	 * @return string
	 */
	public function generateAlias($varValue, DataContainer $dc)
	{
		$autoAlias = false;

		// Generate alias if there is none
		if (!strlen($varValue))
		{
			$autoAlias = true;
			$varValue = standardize($this->restoreBasicEntities($dc->activeRecord->type));
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_alert WHERE alias=?")
								   ->execute($varValue);

		// Check whether the news alias exists
		if ($objAlias->numRows > 1 && !$autoAlias)
		{
			throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
		}

		// Add ID to alias
		if ($objAlias->numRows && $autoAlias)
		{
			$varValue .= '-' . $dc->id;
		}

		return $varValue;
	}
	
	
	/**
	 * Auto-generate the next alert number
	 * @param mixed
	 * @param DataContainer
	 * @return string
	 */
	public function load_callback_alertNumber($varValue, DataContainer $dc)
	{
	
		if ($varValue == '' || $varValue == 0)
		{
			$pid = $dc->activeRecord->pid;

			$objAlertNumber = $this->Database->prepare("SELECT alertNumber FROM tl_alert WHERE pid=?")
										   	 ->execute($pid);
		
			$objAlertNumbers = $objAlertNumber->fetchAllAssoc();
			
			$varValue = max($objAlertNumbers);
			
			$varValue = $varValue['alertNumber'] + 1;
		}

		return $varValue;
	}


	/**
	 * Return the alert markup 
	 * @param array
	 * @return string
	 */
	public function listalert($arrRow)
	{
		$time = time();
		$key = ($arrRow['published'] && ($arrRow['start'] == '' || $arrRow['start'] < $time) && ($arrRow['stop'] == '' || $arrRow['stop'] > $time)) ? 'published' : 'unpublished';
		
		$date = $this->parseDate("d.m.Y H:i",$arrRow['dateStart']);
	
		return '<div class="cte_type ' . $key . '"><strong>' . $GLOBALS['TL_LANG']['tl_alert']['alertNumberList'] . ': ' . $arrRow['alertNumber'] .'</strong></div>
				<div class="limit_height">' . $arrRow['type'] . ' - ' . $date . $images . '</div>' . "\n";
	}


	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_alert::published', 'alexf'))
		{
			return '';
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}		

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}


	/**
	 * Disable/enable aan alert‚‚
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{	
		// Check permissions to publish
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_alert::published', 'alexf'))
		{
			$this->log('Not enough permissions to publish/unpublish news item ID "'.$intId.'"', 'tl_alert toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$this->createInitialVersion('tl_alert', $intId);

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_alert']['fields']['published']['save_callback']))
		{
		$this-log('trigger','foo',TL_ERROR);
			foreach ($GLOBALS['TL_DCA']['tl_alert']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_alert SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_alert', $intId);
		
	}
}