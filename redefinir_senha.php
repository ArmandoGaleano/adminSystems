<?php
    require_once("class/Connection.php");
    require_once("class/CRUD.php");
    require_once("class/GeneratorKeyAccess.php");
    require_once("class/Functions.php");
    
    $CRUD = new CRUD();

    $functions = new Functions();

if(isset($_POST['emailResetPass'])){
    
    //GET EMAIL AND PASSWORD
    $emailForm = preg_replace('/[^[:alnum:]_.-@]/','',$_POST['emailResetPass']);
    $emailInDb = $CRUD->select('adminEmail','adminusers','adminEmail', $emailForm);
    
    
    if(!empty($emailInDb['adminEmail'])){
        //GENERATE A KEY FOR RESET PASSWORD
        $registeredEmail = true;
        $emailDB = preg_replace('/[^[:alnum:]_.-@]/','',$emailInDb['adminEmail']);
        $generatorKeyAccess = new GeneratorKeyAccess();
        $key = $generatorKeyAccess->generateKeyAdmin($emailDB);
        
        //sendEmail
        if($functions->sendEmailResetPass($emailInDb['adminEmail'],$key)){
            echo "E-mail enviado com sucesso!";
        }else{
            echo "Erro ao enviar E-mail";
        }
        if(isset($_POST['resend'])){
            $functions->sendEmailResetPass($emailInDb['adminEmail'],$key);
            echo "E-mail reenviado!";
        }
        echo $key;
       
    }else{
        $unregisteredEmail = true;
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

    <title>Redefinir Senha</title>
    <style>
        .lower{
            font-weight: 400;
        }
    </style>
</head>

<body>
    <?php if(!isset($registeredEmail)){?>
    <div class="container-fluid">
        <div class="row justify-content-center mt-5 pt-5">
            <form class="border p-5" method="post">
                <div class="text-center pb-4">
                    <i class="fas fa-lock pb-4" style="font-size: 80px;text-shadow: 11px 5px #0000001c;"></i>
                    <h2>Esqueceu a senha?</h2>
                    <h7>Você pode redefinir sua senha aqui.</h7>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="d-flex input-group-addon border-bottom border-left border-top rounded-left px-2 text-primary align-items-center"><i class="fas fa-envelope"></i></span>
                        <input id="email" name="emailResetPass" placeholder="Insira seu e-mail" class="form-control" type="email">
                    </div>

                </div>
                <?php if(isset($unregisteredEmail)){?><h6 style="color:#cb0202;"><i class="far fa-times-circle"></i> Email não encontrado!</h6>
                <?php }?>
                <input type="submit" class="btn btn-primary" value="Localizar Email">
                
            </form>
        </div>
    </div>
    <?php }else{?>

    <div class="container-fluid">
        <div class="row align-items-center flex-column mt-5 pt-5">
            <div>
                <h2 class="mb-4" style="font-weight: bolder;"><i class="far fa-envelope"></i> Acabamos de lhe enviar um e-mail com um link</h2>
                <h3 class="lower">Verifique sua caixa de entrada</h3>
                
                <form method="post">
                   <input type="hidden" name="emailResetPass" value="<?php if(isset($_POST['emailResetPass'])){ echo $_POST['emailResetPass'];}?>">
                    <button class="btn btn-primary mb-4" name="resend" type="submit">Reenviar link</button>
                </form>
                
                <h5 class="lower">Se não encontrar nosso e-mail, verifique a pasta de lixo eletrônico</h5>
            </div>
        </div>
    </div>
    <?php }?>
    <script src="assets/node_modules/jquery/dist/jquery.min.js"></script>
</body>

</html>
