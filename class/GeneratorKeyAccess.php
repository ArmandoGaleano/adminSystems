<?php
    class GeneratorKeyAccess extends ConnectionDB {
        public function generateKeyAdmin($email){
            $stmt = $this->connDB()->prepare("SELECT * FROM adminusers WHERE adminEmail = ?");
            $stmt->bindParam(1,$email,PDO::PARAM_STR);
            $stmt->execute();
            $consultReturn = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($consultReturn){
                $key = sha1($consultReturn['userAdminID'].$consultReturn["adminPassword"]);
                return $key;
            }
            
            
        }
        public function checkKey($email,$key){
            $stmt = $this->connDB()->prepare("SELECT * FROM adminusers WHERE adminEMAIL = :email");
            $stmt->bindValue(":email",$email);
            $run = $stmt->execute();
            
            $rs = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rs){
                $correctKey = sha1($rs['userAdminID'].$rs["adminPassword"]);
                if($key == $correctKey){
                    return $rs['userAdminID'];
                }
            }
        }
    }
?>