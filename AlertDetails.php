<?php

class AlertDetails extends System {

    public function getDetails() {

        if ($this->Input->post('_method') === 'getDetails' and $this->Input->post('id') !== '') {

            $objTemplate = new FrontendTemplate('fwm_alertDetailsMap');

            $this->import('Database');

            $objAlert = $this->Database->prepare('SELECT *
                                                    FROM tl_alert
                                                    WHERE id = ?')
            ->execute($this->Input->post('id'));

            $objAlert = $objAlert->fetchAllAssoc()[0];

            $objAlert['date'] = $this->parseDate($GLOBALS['TL_CONFIG']['dateFormat'], $objAlert['dateStart']);

            $objTemplate->alert = $objAlert;

            header('Content-Type: application/json');

            echo $objTemplate->parse();

            exit;
        }
    }
}
