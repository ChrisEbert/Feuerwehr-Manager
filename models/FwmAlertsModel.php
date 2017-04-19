<?php

namespace Contao;

class FwmAlertsModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_fwm_alerts';

	public static function getAlertById($id)
	{
		return static::findByPk($id);
	}

	public static function getAlertsByYear($year, $arrOptions=array(), $published = true)
	{
		$arrOptions['order'] = 'dateStart DESC';


		$from = mktime(0,0,0,1,1,$year);
		$to = mktime(0,0,0,1,1,$year + 1);

		$query = array("dateStart >= $from AND dateStart < $to");

		if ($published === true) {
			$query[] = 'published=1';
		}

		return static::findBy($query, null, $arrOptions);
	}

	public static function getAlertsByDepartment($id, $intLimit=0, array $arrOptions=array())
	{
		$arrOptions['limit'] = $intLimit;
		$arrOptions['order'] = 'dateStart DESC';

		return static::findBy(array("departments LIKE '%:" . '"' . $id . '"' . "%'", "published=1"), null, $arrOptions);
	}
}
