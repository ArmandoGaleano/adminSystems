<?php
    class SessionAdmin extends CRUD {
        private $email;
        private $pass;
        public $menssage;
        public function __construct($email,$pass){
            $this->email = $email;
            $this->pass = $pass;
        }
        
        private function checkEmailPass(){
            $data = $this->select('adminEmail, adminPassword','adminusers','adminEmail',$this->email);
            $emailDB = $data['adminEmail'];
            $passDB = $data['adminPassword'];
            
            if($this->email == $emailDB && $this->pass == $passDB){
                return true;
            }
            else{
                $this->menssage = 'Email ou senha estão incorretos!';
                return false;
            }
        }
        public function login(){
            if($this->checkEmailPass()){
                $userID = $this->select('userAdminID','adminusers','adminEmail',$this->email);
                $_SESSION['adminUser'] = $userID['userAdminID'];
                header('location: products.php');
            }   
        }
    }
?>