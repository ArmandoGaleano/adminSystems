<?php
    require_once('assets/include/authorization.php');
    require_once('class/Connection.php');
    require_once("class/CRUD.php");
    require_once("class/changeRegistration.php");
    $CRUD = new CRUD();
    $dataUser = $CRUD->select("*","adminusers","userAdminID",$_SESSION['adminUser']);

    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['newPassword'];
        $confirmPass = $_POST['confirmPass'];

        $adminUser = new adminUser($name,$email,$phone,$password,$confirmPass,$_SESSION['adminUser']);
        $adminUser->updateUser();
        
    }

    
    
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="assets/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="icon" type="imagem/x-icon" href="assets/images/user.png" />

    <link rel="stylesheet" href="assets/css/alterarProduto.css">
</head>

<body>
    <div class="page-wrapper chiller-theme toggled bg-light">
        <?php include_once("assets/include/nav.php");?>
        <form class="page-content container-fluid" method="post">
            <div class="row border shadow bg-white">
                <div class="col-12 text-center my-4">
                    <h1>Alteração de Cadastro</h1>
                </div>
                <div class="form-group col-5">
                    <label for="email">Nome:</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-dark text-white"><b><i class="fas fa-user"></i></b></div>
                        </div>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Insira o nome da conta" value="<?php echo $dataUser["adminName"]?>">
                        <?php if(!empty($adminUser->error)){
                                    foreach($adminUser->error as $e){
                                        
                                        if($e === "Necessário preencher o nome"){
                                    
                                
                        ?>
                        <h6 class="text-danger col-12"><i class="far fa-times-circle"></i> Necessário preencher o nome</h6>
                        <?php 
                                            break;
                                        }
                                    }
                                }
                        ?>
                    </div>
                </div>
                <div class="form-group col-7">
                    <label for="email">E-mail:</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-primary text-white"><b>@</b></div>
                        </div>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Insira seu e-mail"
                            value="<?php echo $dataUser["adminEmail"]?>">
                            <?php if(!empty($adminUser->error)){
                                    foreach($adminUser->error as $e){
                                        
                                        if($e === "E-mail inválido!" || $e === "Preencha o e-mail"){
                                    
                                
                        ?>
                        <h6 class="text-danger col-12"><i class="far fa-times-circle"></i> <?php echo $e?></h6>
                        <?php 
                                            break;
                                        }
                                    }
                                }
                        ?>
                    </div>
                </div>
                <div class="form-group col-12">
                    <label for="phone">Celular:</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-dark text-white"><b><i class="fas fa-phone"></i></b></div>
                        </div>
                        <input type="text" class="form-control phone-mask col-3" name="phone" id="phone"
                            placeholder="(##) #####-####" value="<?php echo $dataUser["adminPhone"]?>">
                            <?php if(!empty($adminUser->error)){
                                    foreach($adminUser->error as $e){
                                        
                                        if($e === "Número de celular inválido" || $e === "Insira o seu número de celular"){

                                    
                                
                        ?>
                        <h6 class="text-danger col-12"><i class="far fa-times-circle"></i> <?php echo $e?></h6>
                        <?php 
                                            break;
                                        }
                                    }
                                }
                        ?>
                    </div>
                </div>
                <div class="form-group col-6">
                    <label for="password">Nova Senha</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-dark text-white"><b><i class="fas fa-key"></i></b></div>
                        </div>
                        <input type="password" class="form-control" name="newPassword" id="newPassword"
                            placeholder="Senha" value="">
                            <?php if(!empty($adminUser->error)){
                                    foreach($adminUser->error as $e){
                                        
                                        if($e === "As senhas não coincidem!"){
                                    
                                
                        ?>
                        <h6 class="text-danger col-12"><i class="far fa-times-circle"></i> As senhas não coincidem!</h6>
                        <?php 
                                            break;
                                        }
                                    }
                                }
                        ?>
                    </div>
                </div>
                <div class="form-group col-6">
                    <label for="password">Confirmar Senha</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-dark text-white"><b><i class="fas fa-key"></i></b></div>
                        </div>
                        <input type="password" class="form-control" name="confirmPass" id="confirmPassword"
                            placeholder="Confirmar senha" value="">
                    </div>
                </div>
                <div class="form-group col-12 mt-4">
                    <input type="submit" class="btn btn-primary shadow" value="Alterar Cadastro">
                </div>
        </form>
    </div>
    <!-- JQUERY -->
    <script src="assets/node_modules/jquery/dist/jquery.min.js"></script>

    <script src="assets/node_modules/popper.js/popper.min.js"></script>
    <!-- JQUERY MASK -->
    <script src="assets/node_modules/jquery-mask/dist/jqueryMask.js"></script>
    <!-- BUNDLE -->
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- BOOTSTRAP 4 -->
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="assets/js/nav.js"></script>
    <!-- BOOTBOX -->
    <script src="assets/node_modules/bootbox/dist/bootbox.all.min.js"></script>
    <script>
        $("#phone").mask("(99) 99999-9999");
    </script>
    <?php
    if(!empty($adminUser->error)){
        $menssageAlert = '';
        foreach($adminUser->error as $e){
            $class = "class='text-danger border-bottom pb-2'";
            $menssageAlert .= '<h5 '.$class.'>'.$e.'</h5>';
            
        }
        echo '<script> bootbox.alert("<h3>Erros: <h3>'.$menssageAlert.'")</script>';
    }
        
    ?>
</body>

</html>