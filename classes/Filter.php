<?php

namespace Fwm;

class Filter extends \Frontend
{
    public function replaceYearInsertTag($strTag)
    {
        $arrSplit = explode('::', $strTag);

        if ($arrSplit[0] != 'fwm' && $arrSplit[0] != 'filterYear')
        {
            return false;
        }

        $year = intval(\Input::get('year'));

        if (empty($year) === true) 
        {
            $year = (int)$this->parseDate('Y', time());
        }
        
        return $year;
    }
}
