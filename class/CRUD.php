<?php
    class CRUD extends ConnectionDB {
        public function select($consult,$table,$where,$param){
            $sql = "SELECT $consult FROM $table WHERE $where = ?";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->bindParam(1,$param,PDO::PARAM_STR);
            $stmt->execute();
            $consultReturned = $stmt->fetch(PDO::FETCH_ASSOC);
            return $consultReturned;
            
        }
        public function selectAll($consult,$table,$where,$param){
            $sql = "SELECT $consult FROM $table WHERE $where = ?";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->bindParam(1,$param,PDO::PARAM_STR);
            $stmt->execute();
            $consultReturned = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $consultReturned;
            
        }
        public function selectLike($consult,$table,$where,$param){
            $sql = "SELECT $consult FROM $table WHERE $where LIKE '%$param%'";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->execute();
            $consultReturned = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $consultReturned;
            
        }
        public function simpleSelect($consult,$table){
            $sql = "SELECT $consult FROM $table";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->execute();
            $consultReturned = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $consultReturned;
        }
        public function selectLimitProducts($incio,$quantidade_pg,$filter){
            $sql = "SELECT * FROM produtos ";
            if(!empty($filter)){
                $sql .= "WHERE nomeProduto LIKE '%$filter%' ";
            }
            $sql .= "limit $incio, $quantidade_pg ";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->execute();
            $consultReturned = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $consultReturned;
        }
        public function selectForUpdate($consult,$table,$where,$param){
            $sql = "SELECT $consult FROM $table WHERE $where <> ?";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->bindParam(1,$param,PDO::PARAM_STR);
            $stmt->execute();
            $consultReturned = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $consultReturned;
            
        }
        public function selectInnerJoin($consult,$table1,$table2,$ON){
            $sql = "SELECT $consult FROM $table1 INNER JOIN $table2 ON $ON";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->execute();
            $consultReturned = $stmt->fetch(PDO::FETCH_ASSOC);
            return $consultReturned;
            
        }
        public function updatePf($table,$c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$where,$param){
            $sql = "UPDATE $table set primeiroNome = ?,sobrenome = ?,sexo = ?,ddd = ?,celular = ?,dataNascimento = ?,email = ?,senha = ?,cpf = ? WHERE $where = $param";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->bindParam(1,$c1,PDO::PARAM_STR);
            $stmt->bindParam(2,$c2,PDO::PARAM_STR);
            $stmt->bindParam(3,$c3,PDO::PARAM_STR);
            $stmt->bindParam(4,$c4,PDO::PARAM_STR);
            $stmt->bindParam(5,$c5,PDO::PARAM_STR);
            $stmt->bindParam(6,$c6,PDO::PARAM_STR);
            $stmt->bindParam(7,$c7,PDO::PARAM_STR);
            $stmt->bindParam(8,$c8,PDO::PARAM_STR);
            $stmt->bindParam(9,$c9,PDO::PARAM_STR);
            $stmt->execute();
        }
        public function updatePj($table,$c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$where,$param){
            $sql = "UPDATE $table set primeiroNome = ?,sobrenome = ?,sexo = ?,ddd = ?,celular = ?,dataNascimento = ?,email = ?,senha = ?,cnpj = ? WHERE $where = $param";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->bindParam(1,$c1,PDO::PARAM_STR);
            $stmt->bindParam(2,$c2,PDO::PARAM_STR);
            $stmt->bindParam(3,$c3,PDO::PARAM_STR);
            $stmt->bindParam(4,$c4,PDO::PARAM_STR);
            $stmt->bindParam(5,$c5,PDO::PARAM_STR);
            $stmt->bindParam(6,$c6,PDO::PARAM_STR);
            $stmt->bindParam(7,$c7,PDO::PARAM_STR);
            $stmt->bindParam(8,$c8,PDO::PARAM_STR);
            $stmt->bindParam(9,$c9,PDO::PARAM_STR);
            $stmt->execute();
        }
        public function updateWithoutNewPassPf($table,$c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$where,$param){
            $sql = "UPDATE $table set primeiroNome = ?,sobrenome = ?,sexo = ?,ddd = ?,celular = ?,dataNascimento = ?,email = ?,cpf = ? WHERE $where = $param";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->bindParam(1,$c1,PDO::PARAM_STR);
            $stmt->bindParam(2,$c2,PDO::PARAM_STR);
            $stmt->bindParam(3,$c3,PDO::PARAM_STR);
            $stmt->bindParam(4,$c4,PDO::PARAM_STR);
            $stmt->bindParam(5,$c5,PDO::PARAM_STR);
            $stmt->bindParam(6,$c6,PDO::PARAM_STR);
            $stmt->bindParam(7,$c7,PDO::PARAM_STR);
            $stmt->bindParam(8,$c8,PDO::PARAM_STR);
            $stmt->execute();
        }
        public function updateWithoutNewPassPj($table,$c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$where,$param){
            $sql = "UPDATE $table set primeiroNome = ?,sobrenome = ?,sexo = ?,ddd = ?,celular = ?,dataNascimento = ?,email = ?,cnpj = ? WHERE $where = $param";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->bindParam(1,$c1,PDO::PARAM_STR);
            $stmt->bindParam(2,$c2,PDO::PARAM_STR);
            $stmt->bindParam(3,$c3,PDO::PARAM_STR);
            $stmt->bindParam(4,$c4,PDO::PARAM_STR);
            $stmt->bindParam(5,$c5,PDO::PARAM_STR);
            $stmt->bindParam(6,$c6,PDO::PARAM_STR);
            $stmt->bindParam(7,$c7,PDO::PARAM_STR);
            $stmt->bindParam(8,$c8,PDO::PARAM_STR);
            $stmt->execute();
        }
        public function updateAddress($table,$c1,$c2,$c3,$c4,$c5,$c6,$c7,$where,$param){
            $sql = "UPDATE $table set cep = ?,rua = ?,número = ?,complemento = ?,bairro = ?,cidade = ?,estado = ? WHERE $where = $param";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->bindParam(1,$c1,PDO::PARAM_STR);
            $stmt->bindParam(2,$c2,PDO::PARAM_STR);
            $stmt->bindParam(3,$c3,PDO::PARAM_STR);
            $stmt->bindParam(4,$c4,PDO::PARAM_STR);
            $stmt->bindParam(5,$c5,PDO::PARAM_STR);
            $stmt->bindParam(6,$c6,PDO::PARAM_STR);
            $stmt->bindParam(7,$c7,PDO::PARAM_STR);
            $stmt->execute();
        }
        public function updatePassAdmin($password, $id){
            $stmt = $this->connDB()->prepare("UPDATE adminusers SET adminPassword = :password WHERE userAdminID = :id");
            $stmt->bindValue(":password",$password);
            $stmt->bindValue(":id",$id);
            $run = $stmt->execute();
        }
        protected function insertTableUser(
            $tipo,$primieroNome,$sobrenome,$sexo,$ddd,$celular,$dataNascimento,$email,$senha,$cpf,$cnpj
        ){ 
            $sql = "INSERT INTO usuarios values(DEFAULT,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->bindParam(1,$tipo,PDO::PARAM_STR);
            $stmt->bindParam(2,$primieroNome,PDO::PARAM_STR);
            $stmt->bindParam(3,$sobrenome,PDO::PARAM_STR);
            $stmt->bindParam(4,$sexo,PDO::PARAM_STR);
            $stmt->bindParam(5,$ddd,PDO::PARAM_STR);
            $stmt->bindParam(6,$celular,PDO::PARAM_STR);
            $stmt->bindParam(7,$dataNascimento,PDO::PARAM_STR);
            $stmt->bindParam(8,$email,PDO::PARAM_STR);
            $stmt->bindParam(9,$senha,PDO::PARAM_STR);
            $stmt->bindParam(10,$cpf,PDO::PARAM_STR);
            $stmt->bindParam(11,$cnpj,PDO::PARAM_STR);
            $stmt->execute();
            return true;
            
        }
        protected function insertTableAddress(
            $enderecoID,$cep,$street,$number,$complement,$neighborhood,$city,$state
        ){
            
            $sql = "INSERT INTO enderecos values(?,?,?,?,?,?,?,?)";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->bindParam(1,$enderecoID,PDO::PARAM_INT);
            $stmt->bindParam(2,$cep,PDO::PARAM_STR);
            $stmt->bindParam(3,$street,PDO::PARAM_STR);
            $stmt->bindParam(4,$number,PDO::PARAM_STR);
            $stmt->bindParam(5,$complement,PDO::PARAM_STR);
            $stmt->bindParam(6,$neighborhood,PDO::PARAM_STR);
            $stmt->bindParam(7,$city,PDO::PARAM_STR);
            $stmt->bindParam(8,$state,PDO::PARAM_STR);
            $stmt->execute();
            return true;
        }
        public function insertTableCart(
            $userId,$productId,$quantity,$size
        ){
            
            $sql = "INSERT INTO carrinho values(?,?,?,?)";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->bindParam(1,$userId,PDO::PARAM_INT);
            $stmt->bindParam(2,$productId,PDO::PARAM_STR);
            $stmt->bindParam(3,$quantity,PDO::PARAM_STR);
            $stmt->bindParam(4,$size,PDO::PARAM_STR);
            $stmt->execute();
            return true;
        }
        //paginacao
        public function consult($sql){
            $codeSql = "$sql";
            $stmt = $this->connDB()->prepare($codeSql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function consultWithLimit($sql,$incio,$quantidade_pg){
            $codeSql = "$sql limit $incio, $quantidade_pg";
            $stmt = $this->connDB()->prepare($codeSql);
            $stmt->execute();
            return $stmt->fetchAll();

        }
        public function deleteProduct($id){
            $stmt = $this->connDB()->prepare('DELETE FROM produtos WHERE produtoID = :id');
            $stmt->bindValue(':id',$id);
            $stmt->execute();
            return $stmt;
        }
        public function insertProduct($nomeProduto,$categoria,$imagem1,$imagem2,$imagem3,$detalhes,$modoDeUsar,$preco){
            $sql = "INSERT INTO produtos values(DEFAULT,?,?,?,?,?,?,?,?)";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->bindParam(1,$nomeProduto,PDO::PARAM_STR);
            $stmt->bindParam(2,$categoria,PDO::PARAM_STR);
            $stmt->bindParam(3,$imagem1,PDO::PARAM_STR);
            $stmt->bindParam(4,$imagem2, isset( $imagem2 ) ? PDO::PARAM_STR : PDO::PARAM_NULL );
            $stmt->bindParam(5,$imagem3, isset( $imagem2 ) ? PDO::PARAM_STR : PDO::PARAM_NULL );
            $stmt->bindParam(6,$detalhes,PDO::PARAM_STR);
            $stmt->bindParam(7,$modoDeUsar,isset( $modoDeUsar ) ? PDO::PARAM_STR : PDO::PARAM_NULL );
            $stmt->bindParam(8,$preco,PDO::PARAM_STR);
            $stmt->execute();
        }
        public function updateProducts($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$param){
            $sql = "UPDATE produtos set nomeProduto = ?,categoria = ?,imagem1 = ?,imagem2 = ?,imagem3 = ?,detalhes = ?,modoDeUsar = ?,preco = ? WHERE produtoid = $param";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->bindParam(1,$c1,PDO::PARAM_STR);
            $stmt->bindParam(2,$c2,PDO::PARAM_STR);
            $stmt->bindParam(3,$c3,PDO::PARAM_STR);
            $stmt->bindParam(4,$c4,PDO::PARAM_STR);
            $stmt->bindParam(5,$c5,PDO::PARAM_STR);
            $stmt->bindParam(6,$c6,PDO::PARAM_STR);
            $stmt->bindParam(7,$c7,PDO::PARAM_STR);
            $stmt->bindParam(8,$c8,PDO::PARAM_STR);
            $stmt->execute();
        }
        public function updateUserAdmin($name,$email,$password,$phone,$userID){
            $sql = "UPDATE adminusers set adminName = ?,adminEmail = ?, adminPassword = ?, adminPhone = ? WHERE userAdminID = ?";
            $stmt = $this->connDB()->prepare($sql);
            $stmt->bindParam(1,$name,PDO::PARAM_STR);
            $stmt->bindParam(2,$email,PDO::PARAM_STR);
            $stmt->bindParam(3,$password,PDO::PARAM_STR);
            $stmt->bindParam(4,$phone,PDO::PARAM_STR);
            $stmt->bindParam(5,$userID,PDO::PARAM_INT);
            $stmt->execute();
        }
    }
?>