<?php
		
	require_once("link.class.php");

	$ltl = new Volkan\LinkShortener\API('bc_vc_uid', 'bc.vc', 'bc_vc_api_key');

	print_r($ltl->short("http://www.google.com/"));