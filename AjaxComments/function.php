<?php

$servername = "localhost";
$username = "joomla3-02";
$password = "ppcGrhdRVnyN7Jdw";

try {
	    $conn = new PDO("mysql:host=$servername;dbname=joomla3-02", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
	    echo 'error'; // Возвращаем ошибку
    }

    	    
if(!$_GET['name'] && !$_GET['email'] && !$_GET['text']) {
	$arrList = array();
	foreach($conn->query('SELECT * from `comments`') as $row) {
		$arr = [
			'name' => $row['name'], 
			'email' => $row['email'], 
			'comment' => $row['comment']
		];
        array_push($arrList, $arr);
    }
    echo json_encode($arrList);
} else {
	$exec = $conn->prepare('INSERT INTO `comments` (`id`, `date`, `name`, `email`, `comment`) VALUES (NULL, CURRENT_TIMESTAMP, ?, ?, ?)');
    $exec->execute([$_GET['name'], $_GET['email'], $_GET['text']]);
}

$conn = null;