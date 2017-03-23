<?php

  ### This is just an example for static pages managed in Cosmic JS

	include('include/init.php');

	$slug = request_str("slug");

	if (!$slug){
		error_404();
	}

	loadlib("cosmic_api");

	$method = "your-bucket/object/" . $slug;

	$args = array(
		'pretty' => "true",
		'hide_metafields' => "true",
		## 'locale' => "en-US", # this will eventually be in the URL ??
	);

	$rsp = cosmic_api_call($method, $args);

	if (!$rsp['ok']){
		error_404();
	}


	#
	# output
	#

	$smarty->assign('object', $rsp['response']['object']);
	$smarty->display('page.txt');
