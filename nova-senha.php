<?php
    require_once("class/Connection.php");
    require_once("class/CRUD.php");
    require_once("class/GeneratorKeyAccess.php");
    
   $CRUD = new CRUD();

if(isset($_POST['email']) && isset($_POST['newPassword'])){
    $email = preg_replace('/[^[:alnum:]_.-@]/','',$_POST['email']);
    $newPassword = md5($_POST['newPassword']);
    
    if(isset($_GET['key'])){
        $generatorKey = new GeneratorKeyAccess();
        $key = preg_replace('/[^[:alnum:]]/','',$_GET['key']);
        if($generatorKey->checkKey($email,$key)){
            //UPDATE PASSWORD
            $userId = $generatorKey->checkKey($email,$key);
            $CRUD->updatePassAdmin($newPassword,$userId);
            $success = true;
            
        }else{
            $unregisteredEmail = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="assets/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/animate.css/animate.min.css">
    <title>Nova Senha</title>
</head>

<body>
   
    <div class="container-fluid">
        <div class="row justify-content-center mt-5 pt-5">
            <form class="border p-5" method="post">
                <div class="text-center pb-4">
                    <i class="fas fa-lock pb-4" style="font-size: 80px;text-shadow: 11px 5px #0000001c;"></i>
                    <h2>Alteração de senha</h2>
                    <h7>Você pode redefinir sua senha aqui.</h7>
                </div>
                <div class="form-group">
                    <div class="input-group mb-2">
                        <span class="d-flex input-group-addon border-bottom border-left border-top rounded-left px-2 text-primary align-items-center"><i class="fas fa-envelope"></i></span>
                        <input id="email" name="email" placeholder="Insira seu e-mail" class="form-control" type="email">
                    </div>
                    <div class="input-group">
                        <span class="d-flex input-group-addon border-bottom border-left border-top rounded-left px-2 text-primary align-items-center"><i class="fas fa-key"></i></span>
                        <input id="newPassword" name="newPassword" placeholder="Nova senha" class="form-control" type="password">
                    </div>

                </div>
                <?php if(isset($unregisteredEmail)){?><h6 style="color:#cb0202;"><i class="far fa-times-circle"></i> Usuário não encontrado!</h6>
                <?php }?>
                <?php
                if(isset($success)){
                ?>
                <h6 class="text-success"><i class="far fa-check-circle"></i> Senha alterada com sucesso!</h6>
                <?php
                }
                ?>
                <input type="submit" class="btn btn-primary" value="Alterar senha">
            </form>
        </div>
    </div>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>

</html>
