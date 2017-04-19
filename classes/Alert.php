<?php

namespace Contao;

class Alert extends \Frontend
{
	public function __construct(array $options = array())
	{
		parent::__construct();

		$this->previewSize = deserialize($options['previewSize']);

		$this->departments = Alert::fetchById(FwmDepartmentsModel::findAll()->fetchAll());

		$this->vehicles = Alert::fetchById(FwmVehiclesModel::findAll(array('order'=>'pid'))->fetchAll());
	}

	public function prepare(array $arrAlert = array())
	{
		global $objPage;

		$alert = array_merge(array(
			'multipleDays' => false,
			'duration' => ''
		), $arrAlert);

		$alert['dateStart'] = array(
			'datetime' => \Date::parse('Y-m-d\TH:i:sP', $arrAlert['dateStart']),
			'timestamp' => $arrAlert['dateStart'],
			'date' => \Date::parse($objPage->datimFormat, $arrAlert['dateStart'])
		);

		if (empty($alert['dateEnd']) === false) {
			$alert['multipleDays'] = true;

			$alert['dateEnd'] = array(
				'datetime' => \Date::parse('Y-m-d\TH:i:sP', $arrAlert['dateEnd']),
				'timestamp' => $arrAlert['dateEnd'],
				'date' => \Date::parse($objPage->datimFormat, $arrAlert['dateEnd'])
			);


			$diff = (int)$alert['dateEnd']['timestamp'] - (int)$alert['dateStart']['timestamp'];

			$init = 685;
			$hours = floor($diff / 3600);
			$minutes = floor(($diff / 60) % 60);

			$alert['duration'] = array($hours, $minutes);
		}

		$alert['images'] = $this->getImages($arrAlert['images']);
		$alert['departments'] = $this->unserializeValues($arrAlert['departments'], $this->departments);
		$alert['vehicles'] = $this->unserializeValues($arrAlert['vehicles'], $this->vehicles);

		return $alert;
	}

	public function fetchById($arr) {
		$arrReturn = array();

		foreach ($arr as $item) {
			$arrReturn[$item['id']] = $item;
		}

		return $arrReturn;
	}

	public function unserializeValues($serialized, $model)
	{
		$unserialized = deserialize($serialized);
		$result = array();

		foreach ($unserialized as $item) {
			$result[] = $model[$item];
		}

		return $result;
	}

	public function getImages($imageSrc) {

		global $objPage;

		$imageSrc = deserialize($imageSrc);

		$images = array();

		// Return if there are no files
		if (!is_array($imageSrc) || empty($imageSrc))
		{
			return '';
		}
		// Get the file entries from the database
		$objFiles = \FilesModel::findMultipleByUuids($imageSrc);
		if ($objFiles === null)
		{
			if (!\Validator::isUuid($imageSrc[0]))
			{
				return '<p class="error">'.$GLOBALS['TL_LANG']['ERR']['version2format'].'</p>';
			}
			return '';
		}

		while ($objFiles->next())
		{
			// Continue if the files has been processed or does not exist
			if (isset($images[$objFiles->path]) || !file_exists(TL_ROOT . '/' . $objFiles->path))
			{
				continue;
			}
			// Single files
			if ($objFiles->type == 'file')
			{
				$objFile = new \File($objFiles->path, true);
				if (!$objFile->isImage)
				{
					continue;
				}
				$arrMeta = $this->getMetaData($objFiles->meta, $objPage->language);
				if (empty($arrMeta))
				{
					if ($objPage->rootFallbackLanguage !== null)
					{
						$arrMeta = $this->getMetaData($objFiles->meta, $objPage->rootFallbackLanguage);
					}
				}
				// Use the file name as title if none is given
				if ($arrMeta['title'] == '')
				{
					$arrMeta['title'] = specialchars($objFile->basename);
				}
				// Add the image
				$images[$objFiles->path] = array
				(
					'id'        => $objFiles->id,
					'uuid'      => $objFiles->uuid,
					'name'      => $objFile->basename,
					'singleSRC' => $objFiles->path,
					'preview'	=> $objFiles->path,
					'alt'       => $arrMeta['title'],
					'imageUrl'  => $arrMeta['link'],
					'caption'   => $arrMeta['caption']
				);

				if (empty($this->previewSize) === false) {
					$images[$objFiles->path]['preview'] = $this->getImage($objFiles->path, $this->previewSize[0], $this->previewSize[1], $this->previewSize[2]);
				}
			}
			// Folders
			else
			{
				$objSubfiles = \FilesModel::findByPid($objFiles->uuid);
				if ($objSubfiles === null)
				{
					continue;
				}
				while ($objSubfiles->next())
				{
					// Skip subfolders
					if ($objSubfiles->type == 'folder')
					{
						continue;
					}
					$objFile = new \File($objSubfiles->path, true);
					if (!$objFile->isImage)
					{
						continue;
					}
					$arrMeta = $this->getMetaData($objSubfiles->meta, $objPage->language);
					if (empty($arrMeta))
					{
						if ($objPage->rootFallbackLanguage !== null)
						{
							$arrMeta = $this->getMetaData($objSubfiles->meta, $objPage->rootFallbackLanguage);
						}
					}
					// Use the file name as title if none is given
					if ($arrMeta['title'] == '')
					{
						$arrMeta['title'] = specialchars($objFile->basename);
					}
					// Add the image
					$images[$objSubfiles->path] = array
					(
						'id'        => $objSubfiles->id,
						'uuid'      => $objSubfiles->uuid,
						'name'      => $objFile->basename,
						'singleSRC' => $objSubfiles->path,
						'preview'	=> $objSubfiles->path,
						'alt'       => $arrMeta['title'],
						'imageUrl'  => $arrMeta['link'],
						'caption'   => $arrMeta['caption']
					);

					if (empty($this->previewSize) === false) {
						$images[$objSubfiles->path]['preview'] = $this->getImage($objSubfiles->path, $this->previewSize[0], $this->previewSize[1], $this->previewSize[2]);
					}
				}
			}
		}

		return $images;
	}
}
