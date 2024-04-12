<?php
class Database{
private $dsn=("mysql:host=localhost:3307;dbname=gestion_tache");
private $user='root';
private $pass='';
public $conn;
function __construct(){
try{
    $this->conn=new PDO($this->dsn,$this->user,$this->pass);
    $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo'erreur'.$e->getMessage();
}
}

}
$db=new Database();
