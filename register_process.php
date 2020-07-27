<?php
    require_once("tools.php");

    echo $user_id = (int)requestValue("code");
    $user_name = requestValue("name");
    $user_password = requestValue("password");

    $host = 'localhost';
    $username = 'root'; # MySQL 계정 아이디
    $password = '1234'; # MySQL 계정 패스워드
    $dbname = 'heart_beat_db';  # DATABASE 이름


    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    try {

        $con = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$username, $password);
    } catch(PDOException $e) {

        die("Failed to connect to the database: " . $e->getMessage());
    }


    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


    try {
        $query = "INSERT INTO user (id, password, name) values ($user_id, \"$user_password\", \"$user_name\")";
        $con->query($query) or die($con->errorInfo());
    } catch(PDOException $e) {
        errorBack("제품코드 및 정보를 다시 확인해 주세요");
    }

    header("Location: main_view.php");
    #session_start();
?>
