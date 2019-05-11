<?php

/** Имя базы данных */
define( 'DB_NAME', '' );

/** Имя пользователя MySQL */
define( 'DB_USER', '' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

function connect() {
	try {
	    return $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	    
	} catch (PDOException $e) {
	    die("Error!: " . $e->getMessage());
	}	
}

function auth($username, $password) {
	$dbh = connect();

	$sth = $dbh->prepare('SELECT * FROM `tp_users` WHERE `username` LIKE \''.$username.'\'');
	$sth->execute();

	$sth = $sth->fetch(PDO::FETCH_ASSOC);

	$result = false;

	if($sth['password'] == md5($password)) {
		$_SESSION['user_id'] = $sth['id'];

		$sth = $dbh->prepare('INSERT INTO `tp_session` (`id`, `user_id`, `useragent`, `hash`) VALUES (NULL, \''.$sth['id'].'\', \''.$_SERVER['HTTP_USER_AGENT'].'\', MD5(\''.$password.'\'));');
		$sth->execute();

		SetCookie("auth",md5($password));

		$result = true;
	}	

	$dbh = null;
	return $result;
	
}

function checkSession() {
	$dbh = connect();

	if (empty($_SESSION['security_check']) && !empty($_COOKIE['auth'])) {
	   $user_id = $_SESSION['user_id'];

	   $sth = $dbh->prepare('SELECT * FROM `tp_session` WHERE `user_id` = '.$user_id.' AND `useragent` LIKE \''.$_SERVER['HTTP_USER_AGENT'].'\' AND `hash` LIKE \''.$_COOKIE['auth'].'\'');
	   $sth->execute();

	   $sth = $sth->fetch(PDO::FETCH_ASSOC);

	   if (!empty($sth)) {
	      $_SESSION['security_check'] = 1;
	   }
	}

	$dbh = null;
	return !empty($_SESSION['security_check']);
}

