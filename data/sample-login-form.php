<?php
session_start();

require_once __DIR__.'/../connection/Connection.php';
require_once __DIR__.'/../model/Util.php';

$resp = array();
$bd = Connection::getConnection();

// Fields Submitted
$username = $_POST["username"];
$pass = $_POST["password"];


// This array of data is returned for demo purpose, see assets/js/neon-forgotpassword.js
$resp['submitted_data'] = $_POST;


// Login success or invalid login data [success|invalid]
// Your code will decide if username and password are correct
$login_status = 'invalid';
if(isset($_POST['token'])){
    if ( Util::validate_token($_POST['token']) ) {
        if (isset($username, $pass)) {
            // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
            if ($stmt = $bd->prepare('SELECT id, nombre, nick ,clave, rol FROM tblusuarios WHERE nick = ?')) {
                // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
                $stmt->bind_param('s', $username);
                $stmt->execute();
                // Store the result so we can check if the account exists in the database.
                $stmt->store_result();
                // If the username exiusts
                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($id, $nombre, $nick, $password, $rol);
                    $stmt->fetch();
                    // Account exists, now we verify the password.
                    // Note: remember to use password_hash in your registration file to store the hashed passwords.
                    //if (password_verify($_POST['password'], $password)) {
                    if ($pass === $password) {
                        // Verification success! User has loggedin!
                        // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
                        $login_status = 'success';
                    }
                }
                $stmt->close();
            }
            $bd->close();
        }
    }
}


$resp['login_status'] = $login_status;


// Login Success URL
if($login_status == 'success')
{
	// If you validate the user you may set the user cookies/sessions here
		#setcookie("logged_in", "user_id");
		#$_SESSION["logged_user"] = "user_id";
    session_regenerate_id();
    $fingerPrint = md5(  $_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']  );
    $_SESSION['lastActive'] = time();
    $_SESSION['fingerPrint'] = $fingerPrint;
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['username'] = $nick;
    $_SESSION['name'] = $nombre;
    $_SESSION['rol'] = $rol;
    $_SESSION['id'] = $id;
	// Set the redirect url after successful login
    $resp['redirect_url'] = 'index';
}

echo json_encode($resp);