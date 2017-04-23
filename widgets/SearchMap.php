<?php

namespace Contao;

class SearchMap extends \Widget
{
  protected $strTemplate = 'be_widget';

  protected $googleMapsApiUrl = 'https://maps.googleapis.com/maps/api/js';

  protected $googleMapsApiKey = '';

  protected $mapCenter = '51.3426968,12.3747656';

  public function generate()
  {
    $objTemplate = new BackendTemplate('be_map_widget');
    $objTemplate->render = false;

		$this->googleMapsApiKey = $this->getApiKey();

    if (empty($this->googleMapsApiKey) === true) {
      $this->addError($GLOBALS['TL_LANG']['MSC']['missingGoogleMapsApiKey']);
    } else {
      $objTemplate->render = true;

      $mainDepartmentId = Config::get('fwmMainDepartment');

      if (empty($mainDepartmentId) === false) {
        $this->mapCenter = FwmDepartmentsModel::getDepartmentById($mainDepartmentId)->row()['latlng'];
      }

      $this->applyScripts();
      $this->applyStyles();
    }

    return($objTemplate->parse());
  }

  public function getApiKey() {
    $apiKey = Config::get('googleMapsApiKey');

    return (empty($apiKey) === false) ? $apiKey : '';
  }

  public function applyScripts() {
    $arrScripts = array();
		$arrScripts[] = sprintf('%s?key=%s&libraries=places&callback=initSearchMapWidget|async', $this->googleMapsApiUrl, $this->googleMapsApiKey);
		$arrScripts[] = 'system/modules/feuerwehr-manager/assets/js/search-map.js';

		foreach ($arrScripts as $javascript)
		{
			$options = \StringUtil::resolveFlaggedUrl($javascript);
			$GLOBALS['TL_MOOTOOLS'][] = \Template::generateScriptTag($this->addStaticUrlTo($javascript), false, $options->async);
		}

    $GLOBALS['TL_MOOTOOLS'][] = \Template::generateInlineScript(sprintf("var mapCenter = '%s';", $this->mapCenter));
  }

  public function applyStyles() {
    $GLOBALS['TL_CSS'][] = 'system/modules/feuerwehr-manager/assets/css/search-map.css';
  }
}
