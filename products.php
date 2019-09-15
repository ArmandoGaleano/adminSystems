<?php
    require_once('assets/include/authorization.php');
    require_once('class/Connection.php');
    require_once("class/CRUD.php");
    $CRUD = new CRUD();
    
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
    <div class="page-wrapper chiller-theme toggled">
        <?php include_once("assets/include/nav.php");?>
        <main class="page-content container-fluid">
            <div class="row p-0 m-0" id="products">

            </div>
        </main>
    </div>
    <!-- JQUERY -->
    <script src="assets/node_modules/jquery/dist/jquery.min.js"></script>

    <script src="assets/node_modules/popper.js/popper.min.js"></script>
    <!-- BUNDLE -->
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- BOOTSTRAP 4 -->
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="assets/js/nav.js"></script>

    <!-- PAGINATION -->
    <script src="assets/js/pagination.js"></script>
</body>

</html>
