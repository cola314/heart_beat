<?php
    require_once("tools.php");

    $host = 'localhost';
    $username = 'root'; # MySQL 계정 아이디
    $password = '1234'; # MySQL 계정 패스워드
    $dbname = 'heart_beat_db';  # DATABASE 이름

    $id = requestValue("code");
    $val = requestValue("val");
    $time = date("Y-m-d H:i:s", time());

    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    try {
        $con = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$username, $password);
    } catch(PDOException $e) {
        die("Failed to connect to the database: " . $e->getMessage());
    }

    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = "Insert into data(id, value, time) values($id, $val, \"$time\")";
    $con->query($query);
    /*
    $query = "Select * from data";
    $result = $con->query($query);

    while($row = $result->fetch())
    {
    	echo $row['id'];
        echo "\n";
    }
    */
    header('Content-Type: text/html; charset=utf-8');
    #session_start();
?>
