<?php
    class adminUser extends CRUD {
        public $error = [];
        public function __construct($name,$email,$phone,$password,$confirmPass,$userID){
            $this->name = $name;
            $this->email = $email;
            $this->phone = $phone;
            $this->password = md5($password);
            $this->confirmPass = md5($confirmPass);
            $this->userID = $userID;
        }
        private function validateEmail(){
            if(!empty($this->email)){
                if (!preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $this->email)) {
                    $this->error[] = "E-mail inválido!";
                }
            }else{
                $this->error[] = "Preencha o e-mail";
            }
        }
        private function validatePhone(){
            if(!empty($this->phone)){
                $phone = str_replace(["(",")","-"," "],"",$this->phone);
                $regexCel = '/[0-9]{2}[6789][0-9]{3,4}[0-9]{4}/';
                if (!preg_match($regexCel, $phone)) {
                    $this->error[] = "Número de celular inválido";
                }
            }else{
                $this->error[] = "Insira o seu número de celular";
            }
        }
        private function validatePass(){
            if($this->password !== $this->confirmPass){
                $this->error[] = "As senhas não coincidem!";
            }
        }
        private function validateAllInputs(){
            if(empty($this->name)){
                $this->error[] = "Necessário preencher o nome";
            }
            $this->validateEmail();
            $this->validatePhone();
            $this->validatePass();
        }
        public function updateUser(){
            $this->validateAllInputs();
            if(empty($this->error)){
                //IF NO PASSWORD
                if(empty($this->password)){
                    $password = $this->select("adminPassword","adminusers","userAdminID",$this->userID);
                    $this->updateUserAdmin($this->name,$this->email,$password,$this->phone,$this->userID);

                }
                //IF HAVE PASSWORD
                else{
                    $this->updateUserAdmin($this->name,$this->email,$this->password,$this->phone,$this->userID);
                }
                
            }
        }
    }

?>