<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=heart_beat_db", "root", "1234");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    exit($e->getMessage());
    //  exit("can not connect mysql");
}
?>
