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
 * Class ModuleAlertFilter
 *
 */
class ModuleAlertFilter extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_fwm_alert_filter';

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

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['fwm_alert_filter'][0]) . ' ###';
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
        $selectedFilters = unserialize($this->filterTypes);

        $filter = array();

        $objAlerts = FwmAlertsModel::findBy('published', 1);

        if ($objAlerts !== null) 
        {
            $objAlertListPage = \PageModel::findWithDetails($this->jumpTo);
        
            if (in_array('year', $selectedFilters) === true) 
            {
                $filter['years'] = array();
                $years = array();

                $activeYearFilter = intval(\Input::get('year'));

                if (empty($year) === true) 
                {
                    $year = (int)$this->parseDate('Y', time());
                }

                while($objAlerts->next()) 
                {
                    $date = $objAlerts->row()['dateStart'];
                    $years[] = $this->parseDate('Y', $date);
                }
                
                $years = array_unique($years);

                foreach ($years as $year) 
                {
                    $filter['years'][$year] = array
                    (
                        'link' => $objAlertListPage->getAbsoluteUrl() . '?year=' . $year,
                        'active' => ($activeYearFilter === (int)$year)
                    );
                }
            }
        }

        $this->Template->filter = $filter;
    }
}
