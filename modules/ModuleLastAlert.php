<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao;


/**
 * Class ModuleLastAlert
 *
 */
class ModuleLastAlert extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_fwm_last_alert';

	/**
	 * Display a wildcard in the back end
	 *
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			/** @var \BackendTemplate|object $objTemplate */
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['fwm_last_alert'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		$objAlertListPage = \PageModel::findWithDetails($this->jumpTo);

		if ($objAlertListPage !== null) {
			$this->Template->alertListPage = $objAlertListPage->getAbsoluteUrl();
		}
		
		$department = $this->fwm_departments;

		$objAlert = \FwmAlertsModel::getAlertsByDepartment($department, 1);
		
		if ($objAlert !== null) 
        {
			$alert = new Alert();

			$this->Template->alert = $alert->prepare($objAlert->row());
		}
	}
}