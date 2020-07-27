<?php
header("Content-Type: application/json");

#sql
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



$method = $_SERVER['REQUEST_METHOD'];
$name = "";
$id = "";

if($method == "GET") {
    // 1. 자바스크립트 객체 또는 serialize() 로 전달
    $name = $_GET['name'];
    $code = $_GET['id'];
    $time = $_GET['time'];

    $query = "Select * from data where id=$code and time > \"$time\" order by time asc";
    $result = $con->query($query);

    $re = array();

    while($row = $result->fetch())
    {
        array_push($re, json_encode(array("time" => $row['time'], "val" => $row['value'])));
    }
    echo(json_encode($re));
    // 2. JSON.stirngify() 함수로 전달
    //$data = json_decode($_GET['data']);
    //echo(json_encode(array("mode" => $_REQUEST['mode'], "name" => $data->name, "email" => $data->email)));
}

else if($method == "POST") {
    // 1. 자바스크립트 객체 또는 serialize() 로 전달
    $name = $_POST['name'];
    $email = $_POST['id'];
    echo(json_encode(array("mode" => $_REQUEST['mode'], "name" => $name, "id" => $email)));

    // 2. JSON.stirngify() 함수로 전달
    //$data = json_decode($_POST['data']);
    //echo(json_encode(array("mode" => $_REQUEST['mode'], "name" => $data->name, "email" => $data->email)));
}
?>
