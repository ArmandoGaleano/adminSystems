<?php
    abstract class ConnectionDB {
        private $userDB = "root";
        private $passDB = "";
        
       protected function connDB(){
            try{
                $conn = new PDO('mysql:host=localhost;dbname=db;charset=utf8',$this->userDB,$this->passDB);
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                return $conn;
            }
            catch(PDOexception $e){
                echo "Erro ao conectar ao BD! ". $e->getMessage();
            }
        }
    }
?>