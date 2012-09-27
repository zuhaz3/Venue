<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');

	$train = false;
	
	//Array to store validation errors
	$errmsg_arr = array();
	
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
	$cpassword = clean($_POST['cpassword']);
	
	//Input Validations
	/*if (preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $login) == true){}
	    else
	    {
	      $errmsg_arr[] = 'Please enter a valid email address.';
	      $errflag = true;
	    }
	if($login == '') {
		$errmsg_arr[] = 'Please enter your email';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if(strlen($password) < 6)
	{
		$errmsg_arr[] = 'Password is too short';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}*/
	if($login == NULL) { $errmsg_arr[] = 'Please enter your email.'; $errflag = true;}
	  if ($errmsg_arr == NULL)
	  {
	    if (preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $login) == true){}
	    else
	    {
	      $errmsg_arr[] = 'Please enter a valid email address.';
	      $errflag = true;
	    }
	  }
	  if($errmsg_arr == NULL && $password == NULL){ $errmsg_arr[] = 'Please enter a password.'; $errflag = true;}
	  if($errmsg_arr == NULL && $password != $cpassword){ $errmsg_arr[] = 'Your passwords do not match.'; $errflag = true;}
	  if($errmsg_arr == NULL && strlen($password) < 6){
	    $errmsg_arr[] = 'Make sure your passwords are at least 6 characters.';
	    $errflag = true;
	  }



	
	//Check for duplicate login ID
	if($login != '') {
		$qry = "SELECT * FROM members WHERE login='$login'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'This user already exists. If you have an account you can login in the top right hand corner.';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: register.php");
		exit();
	}

	//Create INSERT query
	$qry = "INSERT INTO members(login, passwd) VALUES('$login','".md5($_POST['password'])."')";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		$train = 5;
		$_SESSION['train'] = $train;
		header("location: register.php");
		exit();
	}else {
		die("Query failed");
	}
?>