<?php

namespace Contao;

class AlertFbBot extends System
{
	public function post(DataContainer $dc)
	{
		$fb = new \Facebook\Facebook([
			'app_id' => '1821340168138389',
			'app_secret' => '447c8f5e45abb7aff097b051443df3b6',
			'default_graph_version' => 'v2.8',
		]);

		$tokenUrl = 'https://graph.facebook.com/oauth/access_token?client_id=1821340168138389&client_secret=447c8f5e45abb7aff097b051443df3b6&grant_type=fb_exchange_token&fb_exchange_token=EAAZA4f828rpUBAD6nfbhnPeX2cbZCKzmOcPGJvHlxsVxFyDhzpxRC27ZAZArpJEoHrv9m84iVatPrTZAym15ZBvZC4C7elF5UvZB865YrTeNn49G62OAO1SIQnaMyxMycelnzNUJfdo4iUQY9vZCDaaYGf45AA2stXfja8O4CfcHP15u6WXf3rZCww';
		$accessToken = "EAAZA4f828rpUBACUwDzphJgIUZAc0io1XgyKxf6ZBycOD9Mw1LtWxRCq00J4bGRUBmZB4YVZC9NnebimPBCQWkDHRXL1whcLJMxZBYF8F8c5RdiZCzfzFY7iroKGmDNjCfDtufmCWnJYKuV4SrTGoOu44kZCgXkMf4YZD";

		$linkData = [
			'link' => 'http://www.example.com',
			'message' => 'User provided message',
		];

		$message = '
			Einsatznummer:

		';

		$id = $this->Input->get('id');

		$alerts = array_reverse(FwmAlertsModel::getAlertsByYear(2017)->fetchAll());
		$totalAlerts =count($alerts);
		$alertNumber = 0;

		foreach ($alerts as $alert) {
			$alertNumber++;

			if ($alert['id'] === $id) {
				break;
			}
		}

		var_dump($alertNumber);

/*
		try {
			// Returns a `Facebook\FacebookResponse` object
			$response = $fb->post('/246222305402865/feed', $linkData, $accessToken);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		$graphNode = $response->getGraphNode();

		echo 'Posted with id: ' . $graphNode['id'];*/
	}
}
