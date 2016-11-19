<?php
	session_start();
	include '../koneksi.php';	

	if( isset($_GET['signin']) ) {

	    if( ! isset($_SESSION['is_provider_login']) ){

	        $error = null;
	        $client_id = $_GET['client_id'];
	        $redirect_uri = urldecode($_GET['redirect_uri']);
	        $parsed = parse_url($redirect_uri);

	        if( isset($parsed['query']) )
	            parse_str($parsed['query'], $query_args);

	        if( isset($_POST['submit']) ){

	            if( $user = $mysqli->query("SELECT * FROM users WHERE username = '".$_POST['username']."' AND password = '".$_POST['password']."'")->fetch_object()) {

	                $query_args['code'] = rand();
	                $access_token = rand();
	                $expires = strtotime('next hour');
	                $parsed['host'] = rtrim($parsed['host'], '/').'/';
	                $redirect_to = $parsed['scheme'].'://'.$parsed['host'];

	                if( isset($parsed['path']) )
	                    $redirect_to .= $parsed['path'];

	                	$redirect_to .= '?'.http_build_query( $query_args );

	                if( isset($parsed['fragment']) )
	                    $redirect_to .= '#'.$parsed['fragment'];

	                $mysqli->query("DELETE FROM access_privileges WHERE client_id = '$client_id' AND user_id = $user->id");
	                $mysqli->query("INSERT INTO access_privileges (client_id, user_id, code, access_token, redirect_uri, expires) VALUES ('$client_id', '$user->id', '".$query_args['code']."', '$access_token', '$redirect_uri', '$expires')");

	                $_SESSION['is_provider_login'] = $user->id;
	                $_SESSION['name'] = $user->name;

	                header('Location:'.$redirect_to);
	            }

	            $error = '<p>Username atau password salah.</a>';
	        }

	        echo $error;
	        //echo $client_id;
	        echo '<form action="" method="post">';
	        echo '<table>';
	        echo '<tr>';
	        echo '<td>Username</td><td>:</td><td><input type="text" name="username" /></td>';
	        echo '</tr>';
	        echo '<tr>';
	        echo '<td>Password</td><td>:</td><td><input type="password" name="password" /></td>';
	        echo '</tr>';
	        echo '<tr>';
	        echo '<td></td><td></td><td><input type="submit" name="submit" value="Sign In" /></td>';
	        echo '</tr>';
	        echo '</table>';
	        echo '</form>';
	    }
	    else {

	        echo 'Hallo <b>'.$_SESSION['name'].'</b> Saat ini Anda sudah login di OAuth Provider | <a href="http://localhost/sso/oauthServer/?signout">Sign Out</a>';
	    }
	}

	if( isset($_GET['signout']) ) {

	    session_destroy();

	    echo 'Anda kini telah logout dari OAuth Provider. Silahkan login menggunakan OAuth Client Anda.';
	}

	if( isset($_GET['access_token']) && ! isset($_GET['get_data']) ){

	    $code = $_GET['code'];
	    $client_id = $_GET['client_id'];
	    $client_secret = $_GET['client_secret'];
	    $redirect_uri = $_GET['redirect_uri'];
	    $query = "SELECT access_privileges.access_token, access_privileges.expires FROM access_privileges join apps_clients on apps_clients.client_id = access_privileges.client_id WHERE apps_clients.client_id = '$client_id' AND
apps_clients.client_secret = '$client_secret' AND access_privileges.redirect_uri = '$redirect_uri' AND access_privileges.code = '$code'";		
	    $data =$mysqli->query($query)->fetch_array();
	    
	    if( ! $data )
	        $data['error'] = 'Argument query yang Anda berikan tidak cocok.';

	    echo urldecode(http_build_query($data));
	}

	if( isset($_GET['get_data']) ){

	    $access_token = $_GET['access_token'];
	    $query = "SELECT users.id, users.username, users.name FROM access_privileges join users on users.id = access_privileges.user_id WHERE access_privileges.access_token = '$access_token'";
	    $data = $mysqli->query($query)->fetch_object();
	    if( ! $data )
	        $data['error'] = 'Argument query yang Anda berikan tidak cocok.';

	    echo json_encode($data);
	}
?>