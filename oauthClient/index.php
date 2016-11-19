<?php
	session_start();
?>


<?php

include '../libOauth.php';

$oauth = new libOauth();

$serverUri = 'http://localhost/sso/oauthServer/';
$client_id = 'c4ca4238a0b923820dcc509a6f75849b';
$client_secret = '4fc9b72a83a99a594d40b3971874a9be';
$redirect_uri = 'http://localhost/oauthContest/oauthClient/?callback';

if( @$_SESSION['is_login'] == '') {
?>
	<h3>Oauth Client Aplikasi 1</h3>
    <p>
        <a href="http://localhost/sso/oauthClient">Aplikasi 1</a> | <a href="http://localhost/sso/oauthClient_2">Aplikasi 2</a> 
    </p>
	<p>
		<a href="http://localhost/sso/oauthServer/?signin&client_id=<?=$client_id?>&response_type=code&redirect_uri=<?=$redirect_uri?>">Login</a>
	</p>

<?php
}else{
    echo '<p>
        <a href="http://localhost/sso/oauthClient">Aplikasi 1</a> | <a href="http://localhost/oauthContest/oauthClient_2">Aplikasi 2</a> 
    </p>';
    echo '<h3 style="color:red">Aplikasi 1</h3>';
    echo 'Selamat datang <b>' . $_SESSION['name'] . '</b> | <a href="?signout">Sign Out</a>';
} 


if( isset($_GET['callback']) ) {

    $code = $_GET['code'];
    //$provider_token_uri = 'http://localhost/oauthContest/oauthServer/';

    $response = $oauth->get_access_token( $serverUri, $code, 'access_token',  $client_id, $client_secret, $redirect_uri);
    
    
    parse_str($response, $output);
    $access_token = $output['access_token'];
    //echo $access_token;

    $response = $oauth->access_user_resources( $serverUri, $access_token, 'get_data' );

    $data = json_decode( $response );

    $_SESSION['is_login'] = 1;
    $_SESSION['name'] = $data->name;
    $_SESSION['id'] = $data->id;
    //var_dump($_SESSION);
    //die();
    //echo $data->name.' '.$data->id;
    //var_dump($data);
    
    header('Location:http://localhost/sso/oauthClient/');
    exit;
}

if( isset($_GET['restricted_page']) ) {	
    if( $_SESSION['is_login'] != 1){
        header('Location:?login');
    } 
}

if( isset($_GET['signout']) ) {

    session_unset();
    session_destroy();
    header('Location:http://localhost/sso/oauthClient/');
    exit;
    //echo 'Anda kini telah logout. Klik <a href="?">Sign In</a> untuk kembali login.';
}

if ( isset($_GET['self_logout']) ){
    session_unset();
    session_destroy();
}
?>

