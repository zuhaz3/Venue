<?php
	//Start session

	session_start();
	
	//Include database connection details
	require_once('config.php');

	$train = false;
	
	//Array to store validation errors
	$errmsg_arr = NULL;
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);
	
	//Input Validations
  if($login == NULL) { $errmsg_arr[] = 'Please enter your email.'; $errflag = true;}
  if($errmsg_arr == NULL && $password == NULL){ $errmsg_arr[] = 'Please enter your password.'; $errflag = true;}
	
	//If there are input validations, redirect back to the login form

	
	//Create query
	$qry="SELECT * FROM members WHERE login='$login' AND passwd='".md5($_POST['password'])."'";
	$result=mysql_query($qry);
	

	
	//Check whether the query was successful or not
	if($result && $errflag == false) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
			$_SESSION['login'] = $login;
			session_write_close();
			header("location: profile.php");
			exit();
		}else {
			//Login failed
			if ($errmsg_arr == NULL)
			{
				$errmsg_arr[] = 'Invalid username and/or password!';
				$errflag = true;
			}
		}

	} 
		if($errflag == ture) {
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			session_write_close();
			header("location: login.php");
			exit();
		}
		die("Query failed");

		
?>