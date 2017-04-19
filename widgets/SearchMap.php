<?php

namespace Contao;

class SearchMap extends \Widget
{
  protected $strTemplate = 'be_widget';

  public function generate()
  {
		$apiKey = Config::get('googleMapsApiKey');
		$arrScripts = array ();
		$arrScripts[] = sprintf('https://maps.googleapis.com/maps/api/js?key=%s&libraries=places&callback=initSearchMapWidget|async', $apiKey);
		$arrScripts[] = 'system/modules/feuerwehr_manager/assets/js/search-map.js';

		foreach ($arrScripts as $javascript)
		{
			$options = \StringUtil::resolveFlaggedUrl($javascript);
			$GLOBALS['TL_MOOTOOLS'][] = \Template::generateScriptTag($this->addStaticUrlTo($javascript), false, $options->async);
		}

		$mapCenter = FwmDepartmentsModel::getDepartmentById(Config::get('fwmMainDepartment'))->row()['latlng'];

		$GLOBALS['TL_MOOTOOLS'][] = \Template::generateInlineScript(sprintf("var mapCenter = '%s';", $mapCenter));

    $GLOBALS['TL_CSS'][] = 'system/modules/feuerwehr_manager/assets/css/search-map.css';

    $objTemplate = new BackendTemplate('be_map_widget');

    return($objTemplate->parse());
  }
}
