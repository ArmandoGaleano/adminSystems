<?php
require_once('assets/include/authorization.php');
require_once("class/Connection.php");
require_once("class/CRUD.php");
$CRUD = new CRUD();
//functions
require_once('assets/include/functions.php');
if(isset($_POST['nomeProduto'])){
    $nome           = $_POST['nomeProduto'];
    $categoria      = $_POST['select'];
    $preco          = $_POST['preco'];
    $description    = $_POST['description'];
    $inputImg       = [];
   if(isset($_POST['modoUsar'])){
    $modoUsar       = $_POST['modoDeUsar'];
   }
   else{
    $modoUsar = '';
   }


    $form = new form($nome,$categoria,$preco,$description,$modoUsar,$_FILES);

    $form->createProduct();
    if(empty($form->error)){
        header('Location:products.php');
    }
    
  }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/formProducts.css">
    <link rel="stylesheet" href="assets/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <title>Java Script</title>
</head>

<body>
    <div class="page-wrapper chiller-theme toggled">
        <?php include_once("assets/include/nav.php");?>
        <main class="page-content container-fluid" style="background: #dddddd">

            <div class="row  mx-md-none mx-lg-5 border shadow pt-5 bg-light">
                <form class="w-100" method="post" enctype="multipart/form-data">
                    <div class="pl-3 flex-wrap">
                        <h4>Imagem principal <span class="text-danger">obrigatória *</span></h4>
                        <h6 class="text-primary">Apenas imagens com as dimenções menores ou igual 348x280</h6>
                        <h6 class="text-primary"> <span class="text-danger">Recomendado</span> imagens com 348x280</h6>
                        <div style="max-width:165px;height:auto">
                            <img src="" class="preview-img img-fluid">
                        </div>
                        <input type="file" class="inputImg" name='img1' id="cb1">

                        <?php
                        if(isset($error['img1'])){echo '<h5 class="text-danger">'.$error['img1'].'</h5>';}
                        if(isset($mainImg)){echo '<h4 class="text-danger">'.$mainImg.'</h4>';}
                    ?>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center mt-3 border-top pt-4">
                            <input class="checkboxPerson" id="cb2" type="checkbox">
                            <label class="labelPerson" for="cb2">
                                <div class="ball"></div>
                            </label>
                            <label for="cb2">
                                <h4 class="ml-3">Adicionar 2° imagem <span class="text-primary">(opcional)</span></h4>
                            </label>
                        </div>
                        <div class="sanfona sanfonaDisable border-bottom pl-3 pb-3">
                            <div style="max-width:165px;height:auto">
                                <img src="" class="preview-img img-fluid" id='imgPreview'>
                            </div>
                            <input name="img2" class="inputImg" type="file" id="img2">
                            <?php
                            if(isset($error['img2'])){echo '<h5 class="text-danger">'.$error['img2'].'</h5>';}
                            ?>
                        </div>

                    </div>
                    <div class="imagem3 col-12">
                        <div class="d-flex align-items-center pt-4">
                            <input class="checkboxPerson" id="cb3" type="checkbox">
                            <label class="labelPerson" for="cb3">
                                <div class="ball"></div>
                            </label>
                            <label for="cb3">
                                <h4 class="ml-3">Adicionar 3° imagem <span class="text-primary">(opcional)</span></h4>
                            </label>

                        </div>
                        <div class="sanfona sanfonaDisable border-bottom pl-3 pb-3">

                            <div style="max-width:165px;height:auto">
                                <img src="" class="preview-img img-fluid">
                            </div>
                            <input name="img3" class="inputImg" type="file">

                        <?php
                        if(isset($error['img3'])){echo '<h5 class="text-danger">'.$error['img3'].'</h5>';}
                        ?>
                        </div>

                    </div>
                    <div class="d-flex mt-5 px-4 flex-wrap justify-content-center">
                        <div class="form-group mx-4">
                            <label for="nomeProduto">
                                <h5 class="text-primary">Nome do Produto *</h5>
                            </label>
                            <input type="text" class="form-control" id="nomeProduto" placeholder="Produto"
                                name="nomeProduto" maxlength="35">
                        </div>
                        <div class="form-group mx-4">
                            <label for="categoria">
                                <h5 class="text-primary">Categoria</h5>
                            </label>
                            <select class="form-control" id="categoria" name='select'>
                                <option selected value=''>Sem categoria</option>
                                <option value="higiene">Higiêne</option>
                                <option value="roupa">Roupa</option>
                            </select>
                        </div>
                        <div class="form-group mx-4">
                            <label for="preco">
                                <h5 class="text-primary">Preço: *</h5>
                            </label>
                            <div class="d-flex align-items-center">
                                <div class="border-bottom border-left border-top rounded-left bg-dark">
                                    <h5 class="m-0 p-2 text-white">R$</h5>
                                </div>
                                <input type="text" class="form-control rounded-0 rounded-right py-3" id="preco"
                                    placeholder="Número" name="preco" data-mask="00/00/0000">
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="descricao">
                                <h5 class="text-primary">Descrição do Produto *</h5>
                            </label>
                            <textarea class="form-control" id="descricao" rows="6"
                                placeholder="Descreva aqui o seu produto" name='description'></textarea>
                        </div>

                        <div class="col-12 p-0">
                            <div class="d-flex align-items-center py-3">
                                <input class="checkboxPerson" id="cb4" type="checkbox">
                                <label class="labelPerson" for="cb4">
                                    <div class="ball"></div>
                                </label>
                                <label for="cb4">
                                    <h4 class="ml-3">Modo de Usar <span class="text-primary">(opcional)</span></h4>
                                </label>

                            </div>
                            <div class="sanfona sanfonaDisable border-bottom mt-1">
                                <textarea class="form-control" id="modoDeUsar" rows="6"
                                    placeholder="Escreva aqui o modo de usar o produto" name='modoDeUsar'></textarea>
                            </div>

                        </div>
                    </div>
                    <button class="btn btn-primary shadow ml-5 mt-5 mb-5">
                        <b style="font-size: 20px;">Cadastrar Produto</b>
                    </button>
                </form>


            </div>
        </main>
    </div>

    <script src="assets/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/node_modules/bootbox/dist/bootbox.all.min.js"></script>
    <script src="assets/js/formProducts.js"></script>
    <script src="assets/js/nav.js"></script>

    <?php 
        //if have alerts, echo alerts;
        if(!empty($form->error)){
            $menssageAlert = '';
            foreach($form->error as $i){
                $class = "class='text-danger border-bottom pb-2'";
                $menssageAlert .= '<h5 '.$class.'>'.$i.'</h5>';
                
            }
            echo '<script> bootbox.alert("<h3>Erros: <h3>'.$menssageAlert.'")</script>';
        }
        if(isset($statusProduct)){
            $menssageStatus = "<h5 class='text-success'>".$statusProduct."</h5>";
            echo '<script> bootbox.alert("'.$menssageStatus.'") </script>';
        }
        if(!empty($dataProduct['imagem3'])){
            $pathImg = $dataProduct["imagem3"];
            echo '<script> enableMoreImg("'.$pathImg.'") </script>';
        }
    ?>

</body>

</html>