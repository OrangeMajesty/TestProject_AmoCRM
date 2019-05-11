<?php

session_start();

/** Путь к сайту на Wordpress */
define('wp_path', 'http://wp-templates.ru');

require 'db.php';


if((!empty($_GET['username'])) && (!empty($_GET['password']))) {
	$reset = auth($_GET['username'], $_GET['password']);

	if($reset) header('Location: '.explode('?', $_SERVER['REQUEST_URI'])[0].'');
}

/** a - action */
if(checkSession()) {
	if(isset($_GET['a'])) {
		switch($_GET['a']) {
		  case 'posts': $content = getPosts(); break;
		  case 'pages': $content = getPages(); break;
		}
	} else {
		$content = getPosts(); // default
	}
} else {
	$content['access'] = false;
}

function getPosts() {
  $content['page-title'] = 'Posts list';

  $content['items'] = getUrlContent(wp_path . '/wp-json/wp/v2/posts');

  return  $content;
}

function getPages() {
  $content['page-title'] = 'Pages list';

  $content['items'] = getUrlContent(wp_path . '/wp-json/wp/v2/pages');

  return  $content;
}

function getAuth() {
	$content['page-title'] = 'Access error';

}

function getUrlContent($url) {
  $ch = curl_init($url); 

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
  curl_setopt($ch, CURLOPT_HEADER, 0);          
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
  curl_setopt($ch, CURLOPT_ENCODING, "");       
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
  curl_setopt($ch, CURLOPT_TIMEOUT, 120);       
  curl_setopt($ch, CURLOPT_MAXREDIRS, 10);      

  $result = curl_exec($ch);  
  curl_close($ch);

  return json_decode($result);
}


require 'tmpl.php';
