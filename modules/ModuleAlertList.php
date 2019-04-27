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
 * Class ModuleAlertList
 *
 */
class ModuleAlertList extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_fwm_alert_list';

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

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['fwm_alert_list'][0]) . ' ###';
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
		$arrAlerts = array();

		$alertOptions = array(
			'previewSize' => $this->imgSize
		);

		$alert = new Alert($alertOptions);

		switch ($this->listFilter) 
		{
			case 'year':
				$year = intval(\Input::get('year'));

				if (empty($year) === true) 
				{
					$year = (int)$this->parseDate('Y', time());
				}

				$objAlerts = FwmAlertsModel::getAlertsByYear($year);

				break;
		}

		if ($objAlerts !== null) 
		{
			while($objAlerts->next()) 
			{
				$arrAlerts[] = $alert->prepare($objAlerts->row());
			}

			$apiKey = Config::get('googleMapsApiKey');
			$arrScripts = array ();
			$arrScripts[] = sprintf('https://maps.googleapis.com/maps/api/js?key=%s|async', $apiKey);

			foreach ($arrScripts as $javascript)
			{
				$options = \StringUtil::resolveFlaggedUrl($javascript);
				$GLOBALS['TL_MOOTOOLS'][] = \Template::generateScriptTag($this->addStaticUrlTo($javascript), false, $options->async);
			}
		}

		$activeAlert = intval(\Input::get('alert'));

		if (empty($activeAlert) === false) {
			$this->Template->activeAlert = $activeAlert;
		}

		$this->Template->totalAlerts = count($arrAlerts);

		$this->Template->alerts = $arrAlerts;
	}
}
