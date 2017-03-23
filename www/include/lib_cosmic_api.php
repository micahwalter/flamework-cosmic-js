<?php

	loadlib("http");

	$GLOBALS['cosmic_api_endpoint'] = 'https://api.cosmicjs.com/v1/';

	########################################################################

	function cosmic_api_call($method, $args=array(), $more=array()){

		$defaults = array(
			'request_method' => 'GET',
		);

		$more = array_merge($defaults, $more);

		$request_method = strtoupper($more['request_method']);

		$headers = array();

		$http_more = array(
			'http_timeout' => 10,
		);

		if ($request_method == 'GET'){

			$args = http_build_query($args);
			$url = $GLOBALS['cosmic_api_endpoint'] . $method . "?" . $args;
			$rsp = http_get($url, $headers, $http_more);
		}

		else {

			return array(
				'ok' => 0,
				'error' => 'Not a valid request method',
			);
		}

		if (! $rsp['ok']){
			return $rsp;
		}

		$body = $rsp['body'];

		$data = json_decode($body, 'as hash');

		if (! $data){

			return array(
				'ok' => 0,
				'error' => 'Failed to parse response',
			);
		}

		return array(
			'ok' => 1,
			'response' => $data,
		);
	}

	########################################################################
