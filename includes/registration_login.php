<?php
	// variable declaration
	$username = "";
	$email    = "";
	$errors = array();

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = esc($_POST['username']);
		$email = esc($_POST['email']);
		$password_1 = esc($_POST['password_1']);
		$password_2 = esc($_POST['password_2']);

		// form validation
		if (empty($username)) {  array_push($errors, "Please enter your username"); }
		if (empty($email)) { array_push($errors, "Please enter your mail-address"); }
		if (empty($password_1)) { array_push($errors, "Please enter a password"); }
		if ($password_1 != $password_2) { array_push($errors, "The passwords do not match");}
		if (strlen($password_1) < 5) { array_push($errors, "Password too short");}

		// Ensure that no user is registered twice.
		// the email and usernames should be unique
		$user_check_query = "SELECT * FROM users WHERE username='$username'
								OR email='$email' LIMIT 1";

		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if ($user) { // if user exists
			if ($user['username'] === $username) {
			  array_push($errors, "Username already exists");
			}
			if ($user['email'] === $email) {
			  array_push($errors, "Email already exists");
			}
		}
		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$token = openssl_random_pseudo_bytes(16);
		  $token = bin2hex($token);

			$from="blogpostsystem@gmail.com";
			$headersfrom='';
			$headersfrom .= 'MIME-Version: 1.0' . "\r\n";
			$headersfrom .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headersfrom .= 'From: '.$from.' '. "\r\n";

			$message = "Confirm your email on <a href='http://localhost/blogsystem/index.php?token=".$token."&action=reg'>HERE</a>";
			$subject="Confirm your email!";
			$result = mail($email, $subject, $message, $headersfrom);
			{ array_push($errors, "Check your email for confirm!"); }

			$password = password_hash($password_1,  PASSWORD_DEFAULT);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, role, password, created_at, updated_at, token, status)
					  VALUES('$username', '$email', 'Author', '$password', now(), now(), '$token', 0)";
			mysqli_query($conn, $query);

			// get id of created user
			$reg_user_id = mysqli_insert_id($conn);

			// put logged in user into session array
			// $_SESSION['user'] = getUserById($reg_user_id);
			//
			// // if user is admin, redirect to admin area
			// if ( in_array($_SESSION['user']['role'], ["Admin", "Author"])) {
			// 	$_SESSION['message'] = "You are now logged in";
			// 	// redirect to admin area
			// 	header('location: ' . BASE_URL . 'admin/dashboard.php');
			// 	exit(0);
			// } else {
			// 	$_SESSION['message'] = "You are now logged in";
			// 	// redirect to public area
			// 	header('location: index.php');
			// 	exit(0);
			// }
		}
	}

	// LOG USER IN
	if (isset($_POST['login_btn'])) {
		$username = esc($_POST['username']);
		$password = esc($_POST['password']);

		if (empty($username)) { array_push($errors, "Username required"); }
		if (empty($password)) { array_push($errors, "Password required"); }
		if (empty($errors)) {
			$sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {

				$result1 = mysqli_fetch_assoc($result);
				$bool = password_verify($password, $result1['password']);

				if($result1['status'] == 0) {array_push($errors, "User inactiv");}
				// if user is admin, redirect to admin area
				else if ($bool === false) {array_push($errors, "Password incorrect");}
				else {
					// get id of created user
					$reg_user_id = $result1['id'];
					// put logged in user into session array
					$_SESSION['user'] = getUserById($reg_user_id);
					if ( in_array($_SESSION['user']['role'], ["Admin"])) {
						$_SESSION['message'] = "You are now logged in";
						// redirect to admin area
						header('location: ' . BASE_URL . '/admin/dashboard.php');
						exit(0);
					} else {
						$_SESSION['message'] = "You are now logged in";
						// redirect to public area
						header('location: index.php');
						exit(0);
					}
				}
			} else {
				array_push($errors, 'Wrong credentials');
			}
		}
	}
	// escape value from form
	function esc(String $value)
	{
		// bring the global db connect object into function
		global $conn;

		$val = trim($value); // remove empty space sorrounding string
		$val = mysqli_real_escape_string($conn, $value);

		return $val;
	}
	// Get user info from user id
	function getUserById($id)
	{
		global $conn;
		$sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);
		return $user;
	}

	if (isset($_POST['rst_password'])) {
		$token = $_POST['token'];
		if (empty($_POST['password']) || empty($_POST['confirm_password'])) { array_push($errors, "Password required"); }
		if (empty($errors)) {
			$sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {

				$result1 = mysqli_fetch_assoc($result);
				$token = openssl_random_pseudo_bytes(16);
				$token = bin2hex($token);
				$password = password_hash($_POST['password'],  PASSWORD_DEFAULT);//encrypt the password before saving in the database

				mysqli_query($conn, "UPDATE users set token = '$token', password = '$password' where token = '".$_POST['token']."';");
				{ array_push($errors, "Password reset!"); }
			}
			else
			{ array_push($errors, "Token inexistent!"); }
		}
	}

	if (isset($_POST['request_btn'])) {
		$email = esc($_POST['email']);

		if (empty($email)) { array_push($errors, "Email required"); }
		if (empty($errors)) {
			$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {

				$result1 = mysqli_fetch_assoc($result);

				$from="blogpostsystem@gmail.com";
				$headersfrom='';
				$headersfrom .= 'MIME-Version: 1.0' . "\r\n";
				$headersfrom .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headersfrom .= 'From: '.$from.' '. "\r\n";

				$message = "Request your password click on <a href='http://localhost/blogsystem/index.php?token=".$result1['token']."&action=request'>HERE</a>";
				// $message = "Request your password click on <a href='http://localhost/blogsystem/index.php?token=sadsadsadsa'>HERE</a>";
				$subject="Request password!";
				$result = mail($email, $subject, $message, $headersfrom);
				{ array_push($errors, "Check your email for confirm!"); }
				// header("Location: ".BASE_URL."/index.php");
			} else {
				array_push($errors, 'Wrong credentials');
			}
		}
	}
?>
