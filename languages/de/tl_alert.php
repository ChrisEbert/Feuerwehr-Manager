<?php 

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_alert']['type']     		= array('Einsatzstichwort', 'Bitte geben Sie das Einsatzstichwort ein. Achten Sie darauf immer die selbe Schreibweise zu verwenden, damit die Statistik korrekte Ergebnisse anzeigt.');
$GLOBALS['TL_LANG']['tl_alert']['alias'] 			= array('Alias', 'Der Alias ist eine eindeutige Referenz, die anstelle der numerischen ID aufgerufen werden kann.');
$GLOBALS['TL_LANG']['tl_alert']['alertNumber']  	= array('Einsatznummer', 'Die Einsatznummer wird automatisch aus dem letzten Einsatz generiert.');
$GLOBALS['TL_LANG']['tl_alert']['dateStart']    	= array('Anfangszeit', 'Bitte geben Sie das Einsatzdatum und die Anfangszeit ein.');
$GLOBALS['TL_LANG']['tl_alert']['dateEnd']     		= array('Endzeit', 'Bitte geben Sie das Einsatzende ein.');
$GLOBALS['TL_LANG']['tl_alert']['location']     	= array('Einsatzort', 'Bitte geben Sie den Einsatzort an.');
$GLOBALS['TL_LANG']['tl_alert']['description']  	= array('Beschreibung', 'Bitte geben Sie eine Einsatzbeschreibung ein.');
$GLOBALS['TL_LANG']['tl_alert']['imagelink']    	= array('Bilder anzeigen', 'Aktivieren Sie die Checkbox um Bilder hinzuzufügen.');
$GLOBALS['TL_LANG']['tl_alert']['preview']     		= array('Vorschaubild', 'Hier können Sie ein Vorschaubild zur Einsatzbeschreibung hinzufügen.');
$GLOBALS['TL_LANG']['tl_alert']['previewCaption']   = array('Bildunterschrift', 'Hier können Sie eine Bildunterschrift angeben die als Link zur Galerie dient.');
$GLOBALS['TL_LANG']['tl_alert']['alt']     			= array('Alternativer Text', 'Hier können Sie einen alternativen Text für das Bild eingeben (<i>alt</i>-Attribut).');
$GLOBALS['TL_LANG']['tl_alert']['previewTitle']     = array('Linktitel', 'Hier können Sie einen Titel Text für das Bild eingeben (<i>title</i>-Attribut).');
$GLOBALS['TL_LANG']['tl_alert']['previewSize']     	= array('Bildbreite und Bildhöhe', 'Hier können Sie die Abmessungen des Vorschaubildes und den Skalierungsmodus festlegen.');
$GLOBALS['TL_LANG']['tl_alert']['images']     		= array('Bilder', 'Bitte wählen Sie die Bilder für die Galerie aus.');
$GLOBALS['TL_LANG']['tl_alert']['published'] 		= array('Einsatz veröffentlichen', 'Den Einsatz auf der Website anzeigen.');
$GLOBALS['TL_LANG']['tl_alert']['start']     		= array('Anzeigen ab', 'Den Einsatz erst ab diesem Tag auf der Webseite anzeigen.');
$GLOBALS['TL_LANG']['tl_alert']['stop']      		= array('Anzeigen bis', 'Den Einsatz nur bis zu diesem Tag auf der Webseite anzeigen.');



/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_alert']['title_legend']   	= 'Titel';
$GLOBALS['TL_LANG']['tl_alert']['date_legend'] 		= 'Datum';
$GLOBALS['TL_LANG']['tl_alert']['info_legend'] 		= 'Details';
$GLOBALS['TL_LANG']['tl_alert']['images_legend'] 	= 'Bilder';
$GLOBALS['TL_LANG']['tl_alert']['publish_legend'] 	= 'Veröffentlichung';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_alert']['new']    = array('Neuer Einsatz', 'Einen neuen Einsatz erstellen');
$GLOBALS['TL_LANG']['tl_alert']['show']   = array('Einsatzdetails', 'Die Details des Einsatzes Nummer %s anzeigen');
$GLOBALS['TL_LANG']['tl_alert']['edit']   = array('Einsatz bearbeiten', 'Einsatz Nummer %s bearbeiten');
$GLOBALS['TL_LANG']['tl_alert']['copy']   = array('Einsatz duplizieren', 'Einsatz Nummer %s duplizieren');
$GLOBALS['TL_LANG']['tl_alert']['toggle'] = array('Einsatz veröffentlichen/unveröffentlichen', 'Einsatz Nummer %s veröffentlichen/unveröffentlichen');
$GLOBALS['TL_LANG']['tl_alert']['delete'] = array('Einsatz löschen', 'Einsatz Nummer %s löschen');


/**
 * List
 */
$GLOBALS['TL_LANG']['tl_alert']['alertNumberList'] = 'Einsatznummer';

/**
 * select options
 */
$GLOBALS['TL_LANG']['tl_alert']['alertTypes'] = array('Bahn','BMA', 'F-Gebäude', 'F-KFZ', 'F-Klein', 'F-Wald', 'Gefahr','Hochwasser', 'H-Straße', 'H-Sturm', 'H-Tier', 'H-Rettung','H-Tragehilfe', 'H-Vku-Klemm', 'H-Sonstiges', 'Katalarm'); 