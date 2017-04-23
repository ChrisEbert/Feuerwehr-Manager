<?php

$GLOBALS['TL_DCA']['tl_fwm_alerts'] = array
(
	'config' => array
	(
		'dataContainer'               => 'Table',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),
	'list' => array
	(
		'sorting' => array
		(
			'mode'                  => 1,
			'fields'                => array('dateStart'),
			'flag'                  => 10,
			'panelLayout'           => 'filter;search,limit',
		),
		'label' => array
		(
			'fields'                => array('dateStart'),
			'format'                => '%s',
			'label_callback'   			=> array('tl_fwm_alerts', 'listAlert')
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
				'label'               => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_fwm_alerts', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	'palettes' => array
	(
		'__selector__'                => array('imagelink'),
		'default'                     => '{title_legend},type,alias;{date_legend},dateStart,dateEnd;{info_legend},location,latlng,map,description;{forces_legend},departments,vehicles;{images_legend},images;{publish_legend},published'
	),
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'type' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['type'],
			'search'                  => true,
			'filter'				  				=> true,
			'inputType'               => 'select',
			'options'				  				=> deserialize(Config::get('fwmAlertKeys')),
			'eval'                    => array('mandatory'=>true, 'tl_class' => 'w50'),
			'sql'											=> "varchar(255) NOT NULL default ''"
		),
		'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['alias'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'alnum', 'unique'=>true, 'spaceToUnderscore'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'save_callback' => array
			(
				array('tl_fwm_alerts', 'generateAlias')
			),
			'sql' 										=> "varbinary(128) NOT NULL default ''"
		),
		'dateStart' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['dateStart'],
			'serch'					  				=> true,
			'sorting'				  				=> true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim','mandatory'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'											=> "varchar(10) NOT NULL default ''"
		),
		'dateEnd' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['dateEnd'],
			'serch'					  				=> true,
			'sorting'				  				=> true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'											=> "varchar(10) NOT NULL default ''"
		),
		'images' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['images'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('multiple'=>true, 'fieldType'=>'checkbox', 'files'=>true, 'tl_class'=>'clr'),
			'sql'											=> "blob NULL"
		),
		'location' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['location'],
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255,'tl_class'=>'w50'),
			'sql'											=> "varchar(255) NOT NULL default ''"
		),
    'latlng' => array
        (
        'label'                 => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['latlng'],
        'inputType'             => 'text',
        'eval'                  => array('tl_class'=>'w50'),
				'sql'										=> "varchar(255) NOT NULL default ''"
    ),
    'map' => array
    (
        'label'                 => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['map'],
        'inputType'             => 'searchMap',
				'eval'									=> array('tl_class'=>'clr')
    ),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['description'],
			'inputType'               => 'textarea',
			'eval'					  				=> array('rte'=>'tinyMCE'),
			'sql'											=> "text NULL"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'clr','doNotCopy'=>true),
			'sql'											=> "char(1) NOT NULL default ''"
		),
		'departments' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['departments'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'              => 'tl_fwm_departments.title',
			'default'									=> array(Config::get('fwmMainDepartment')),
			'eval'                    => array('tl_class'=>'w50 autoheight', 'multiple'=>true,'size'=>10,'submitOnChange'=>true),
			'sql'											=> "varchar(255) NOT NULL default ''"
		),
		'vehicles' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fwm_alerts']['vehicles'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options_callback'        => array('tl_fwm_alerts', 'getVehicles'),
			'eval'                    => array('tl_class'=>'w50 autoheight', 'multiple'=>true,'size'=>10),
			'sql'											=> "varchar(255) NOT NULL default ''"
		)
	)
);

class tl_fwm_alerts extends Backend
{
	public $tmpNumber = 1;

	public $tmpYear = 0;

	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function listAlert($arrRow)
	{
		$time = time();
		$key = $arrRow['published'] ? 'published' : 'unpublished';

		$date = $this->parseDate("d.m. H:i", $arrRow['dateStart']);
		$year = $this->parseDate("Y", $arrRow['dateStart']);

		if ($year !== $this->tmpYear) {
			$objAlerts = FwmAlertsModel::getAlertsByYear($year, null, false);

			if ($objAlerts) {
				$this->tmpNumber = count($objAlerts->fetchAll());
			}

			$this->tmpYear = $year;
		} else {
			$this->tmpNumber--;
		}

		return '<div class="cte_type ' . $key . '"><strong>' . $GLOBALS['TL_LANG']['tl_fwm_alerts']['alertNumberList'] . ': ' . $this->tmpNumber . '</strong></div>
				<div class="limit_height">' . $date . '; ' . $arrRow['type'] . '; ' . $arrRow['location'] . '</div>' . "\n";
	}

	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_fwm_alerts::published', 'alexf'))
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

	public function toggleVisibility($intId, $blnVisible)
	{
		// Check permissions to publish
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_fwm_alerts::published', 'alexf'))
		{
			$this->log('Not enough permissions to publish/unpublish alert ID "'.$intId.'"', 'tl_fwm_alerts toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$this->createInitialVersion('tl_fwm_alerts', $intId);

		// Update the database
		$this->Database->prepare("UPDATE tl_fwm_alerts SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_fwm_alerts', $intId);
	}

	public function generateAlias($varValue, DataContainer $dc)
	{
		$autoAlias = false;
		// Generate an alias if there is none
		if ($varValue == '')
		{
			$autoAlias = true;
			$varValue = StringUtil::generateAlias($dc->activeRecord->type);
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_fwm_alerts WHERE id=? OR alias=?")
								   ->execute($dc->id, $varValue);
		// Check whether the page alias exists
		if ($objAlias->numRows > 1)
		{
			if (!$autoAlias)
			{
				throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
			}
			$varValue .= '-' . $dc->id;
		}
		return $varValue;
	}

	public function getVehicles(DataContainer $dc){
			$opt = array();
			$departments = $dc->activeRecord->departments;
			$departments = array_filter(deserialize($departments));

			if (empty($departments) === false) {
					$result = FwmVehiclesModel::getVehiclesByDepartmentIds($departments);

					if ($result) {
						while($result->next()){
								$row = $result->row();
								$departmentName = FwmDepartmentsModel::getDepartmentById($row['pid'])->row()['title'];
								$opt[$departmentName][$row['id']] = $row['title'];
						}
					}
			}

			return $opt;
	}
}
