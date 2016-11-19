<?php
Class libOauth {
	public function user_authentication($oauthServerUri, $client_id, $redirect_uri){
		$uri = $oauthServerUri.'?client_id='.$client_id.'&signin=signin&response_type=code&redirect_uri='.$redirect_uri;
		$ch = curl_init(); //buat resource CURL
		//set opsi url
		curl_setopt($ch, CURLOPT_URL, $uri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}

	public function get_access_token($oauthServerUri, $code, $access_token, $client_id, $client_secret, $redirect_uri){
		$uri = $oauthServerUri.'?code='.$code.'&'.$access_token.'&client_id='.$client_id.'&client_secret='.$client_secret.'&redirect_uri='.$redirect_uri;
		$ch = curl_init(); //buat resource CURL
		//set opsi url
		curl_setopt($ch, CURLOPT_URL, $uri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}

	public function access_user_resources($oauthServerUri, $access_token, $get_data){
		$uri = $oauthServerUri.'?access_token='.$access_token.'&'.$get_data;
		$ch = curl_init(); //buat resource CURL
		//set opsi url
		curl_setopt($ch, CURLOPT_URL, $uri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}
}
?>