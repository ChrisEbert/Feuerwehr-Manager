<?php

class SearchMap extends Widget
{

    protected $strTemplate = 'be_widget';

    public function generate()
    {
        $GLOBALS['TL_JAVASCRIPT'][] = 'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places';
        $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/feuerwehr_manager/assets/js/search-map.js';
        $GLOBALS['TL_CSS'][] = 'system/modules/feuerwehr_manager/assets/css/search-map.css';

        $objTemplate = new BackendTemplate('be_map_widget');

        return($objTemplate->parse());
    }
}