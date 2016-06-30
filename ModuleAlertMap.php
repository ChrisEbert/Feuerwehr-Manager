<?php

class ModuleAlertMap extends Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'fwm_alertMap';

    /**
     * Compile the current element
     */
    public function compile()
    {
            if (($this->fwm_template != $this->strTemplate) && ($this->fwm_template != ''))
            {
                $this->strTemplate = $this->fwm_template;
                $this->Template = new FrontendTemplate($this->strTemplate);
            }

            $time = time();

            $alerts = array();

            $objAlerts = $this->Database->prepare('SELECT s.latlng, s.id
                                                   FROM tl_alert s
                                                   INNER JOIN tl_alert_archive a
                                                   ON a.id=s.pid
                                                   WHERE s.pid=a.id
                                                   AND s.latlng <> ""
                                                   AND a.year=?
                                                   AND a.published=?
                                                   AND (a.start=? OR a.start<?)
                                                   AND (a.stop=? OR a.stop>?)
                                                   AND s.published=?
                                                   AND (s.start=? OR s.start<?)
                                                   AND (s.stop=? OR s.stop>?)
                                                   GROUP BY s.latlng')
            ->execute(2014, 1, '', $time, '', $time, 1, '', $time, '', $time);

            while($objAlerts->next()) {
                $latlng = explode(',', $objAlerts->row()['latlng']);

                $alerts[$objAlerts->row()['id']] = array(
                    'lat' => $latlng[0],
                    'lng' => $latlng[1]
                );
            }

            $this->Template->alerts = json_encode($alerts);

    }
}