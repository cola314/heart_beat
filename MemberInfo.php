<?php
class MemberInfo {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=heart_beat_db", "root", "1234");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            exit($e->getMessage());
            //  exit("can not connect mysql");
        }
    }

    public function getMember($id) {
        try {
            $query = $this->db->prepare("select * from user where name = :id");
            $query->bindValue(":id", $id, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            exit($e->getMessage());
        }
        return $result;
    }

    public function getData($id) {
        try {
            $query = $this->db->prepare("select (value, time) from data where name = :id");
            $query->bindValue(":id", $id, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            exit($e->getMessage());
        }
        return $result;
    }

    public function storeData($id, $value, $time) {
        try {
            $query = $this->db->prepare("insert into data values(:id, :value:, :time)");
            $query->bindValue(":id", $id, PDO::PARAM_STR);
            $query->bindValue(":value", $value, PDO::PARAM_STR);
            $query->bindValue(":time", $time, PDO::PARAM_SRT);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            exit($e->getMessage());
        }
    }
}
?>
