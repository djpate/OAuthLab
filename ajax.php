<?php

	function display_err($err){
		return "<div class='error'>".$err."</div>";
	}
	
	function display_array($array){
		$ret = "";
		foreach($array as $id => $val){
			$ret .= "<p><strong>".$id."</strong> : ".$val."</p>";
		}
		return $ret;
	}

	if(empty($_REQUEST['consumer_key'])||empty($_REQUEST['consumer_secret'])){
		echo display_err("Please input your consumer key & secret");
		exit;
	}
	
	if(empty($_REQUEST['url'])){
		echo display_err("Please input the access token url");
		exit;
	}
				
	if(!filter_var($_REQUEST['url'],FILTER_VALIDATE_URL)){
		echo display_err("Invalid url");
		exit;
	}
	
	if(isset($_REQUEST['action'])){
		switch($_REQUEST['action']){
			case 'get_request_token':
				
				try {
					$oauth = new OAuth($_REQUEST['consumer_key'],$_REQUEST['consumer_secret']);
					$oauth->enableDebug();
					$request_token_info = $oauth->getRequestToken($_REQUEST['url']);
					if(!empty($request_token_info)) {
						echo display_array($request_token_info);
					} else {
						echo display_err("Failed fetching request token, response was: <br />" . $oauth->getLastResponse());
					}
				} catch(OAuthException $E){
					echo display_err("Failed fetching request token : <br />".$E->getMessage());
				}
				
			break;
			
			case 'get_access_token':
				
				try {
					$oauth = new OAuth($_REQUEST['consumer_key'],$_REQUEST['consumer_secret']);
					$oauth->enableDebug();
					$oauth->setToken($_REQUEST['token'],$_REQUEST['secret']);
					$access_token_info = $oauth->getAccessToken($_REQUEST['url'],null,$_REQUEST['verifier']);
					if(!empty($access_token_info)) {
						echo display_array($access_token_info);
					} else {
						echo display_err("Failed fetching access token, response was: <br />" . $oauth->getLastResponse());
					}
				} catch(OAuthException $E){
					echo display_err("Failed fetching access token : <br />".$E->getMessage());
				}
			break;
			
			case 'query':
				
				try {
					$oauth = new OAuth($_REQUEST['consumer_key'],$_REQUEST['consumer_secret']);
					$oauth->enableDebug();
					$oauth->setToken($_REQUEST['token'],$_REQUEST['secret']);
					$oauth->fetch($_REQUEST['url']);
					echo print_r($oauth->getLastResponse(),true);
				} catch(OAuthException $E){
					echo display_err("Failed fetching query : <br />".$E->getMessage());
				}
				
			break;
				
		}
	}
?>
