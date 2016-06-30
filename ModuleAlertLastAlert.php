<?php

class ModuleAlertLastAlert extends Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'fwm_alertLast';

    /**
     * Compile the current element
     */
    protected function compile() {
    	if (($this->fwm_template != $this->strTemplate) && ($this->fwm_template != '')) {
        	$this->strTemplate = $this->fwm_template;
        	$this->Template = new FrontendTemplate($this->strTemplate);
     	}

    	$time = time();

    	$objYears = $this->Database->prepare("SELECT id,year
    										  FROM tl_alert_archive
    										  WHERE published=?
    										  AND (start=? OR start<?)
                    						  AND (stop=? OR stop>?)
    										  ORDER BY year DESC")
    							   ->execute(1, '', $time, '', $time);


			$years = $objYears->fetchAllAssoc();

		foreach ($years as $year) {
			$id = $year['id'];

    	$objAlerts = $this->Database->prepare('SELECT s.alertNumber, s.type, s.dateStart, s.location, a.year AS `archive`
					                       FROM tl_alert s
					                       INNER JOIN tl_alert_archive a
					                       ON a.id=s.pid
					                       WHERE s.pid=?
					                       AND s.published=?
					                       AND (s.start=? OR s.start<?)
					                       AND (s.stop=? OR s.stop>?)
					                       ORDER BY s.alertNumber DESC')
					            ->execute($id, 1, '', $time, '', $time);

      $alerts = $objAlerts->fetchAllAssoc();

      if(count($alerts) != 0){
      	$alerts = $alerts[0];
      	break;
      }
		}

		global $objPage;

		$alerts['dateStart'] = $this->parseDate('d.m.Y', $alerts['dateStart']);
		$alerts['datetime'] = $this->parseDate('Y-m-d\TH:i:sP', $alerts['dateStart']);

    	$this->Template->lastAlert = $alerts;
    }
}
