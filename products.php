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
    <!-- BOOTBOX -->
    <script src="assets/node_modules/bootbox/dist/bootbox.all.min.js"></script>
    <script>
        function menssageDelete(nameProduct, id, path) {
            let createMenssage = '<div class="container-fluid"><div class="row"> <p style="font-size: 20px;">Ao confirmar na caixa, você está ciênte que o produto selecionado, <b class="text-danger">' + nameProduct + '</b> será deletado e não será possível reverter este processo após concluído.</p></div></div><label for="termDelete"><input type="checkbox" onclick="ableDisable()" id="termDelete"> Concorda com o termo</label>'
            let createClassName = 'btn btn-danger disabled button-delete';

            bootbox.dialog({
                title: 'Termo de exclusão de produto',
                message: createMenssage,
                size: 'large',
                onEscape: true,
                backdrop: true,
                buttons: {
                    Deletar: {
                        label: '<i class="fas fa-trash"></i> Deletar',
                        className: createClassName,
                        callback: function() {
                            //ajax DELETE
                            let data = new FormData();
                            data.append('id', id);
                            data.append('path',path);
                            $.ajax({
                                url: 'assets/ajax/deleteProduct.php',
                                method: 'post',
                                data: data,
                                processData: false,
                                contentType: false
                            }).done(function(resposta) {
                                bootbox.dialog({
                                    title: 'O produto <b class="text-success">' + nameProduct + '</b> foi deletado com sucesso!</h5>',
                                    message: 'Em caso de engano ao deletar o produto, você pode adicionar o mesmo na página de <a href="adicionar-produto.php">adicionar produtos</a>',
                                    size: 'large',
                                    onEscape: true,
                                    backdrop: true,
                                    buttons: {
                                        OK: {
                                            label: 'OK',
                                            className: 'btn btn-primary',
                                            callback: function() {
                                                location.reload();
                                            }
                                        }

                                    }
                                })
                            });
                        }
                    },
                    Cancelar: {
                        label: '<i class="far fa-window-close"></i> Cancelar',
                        className: 'bootbox-close-button btn btn-primary',
                        callback: function() {

                        }
                    }

                }
            })
        }

        function ableDisable() {
            let input = document.querySelector('#termDelete');
            let buttonDelete = document.querySelector(".button-delete");
            if (input.checked) {
                buttonDelete.classList.remove('disabled');
            } else {
                buttonDelete.classList.add('disabled');
            }

        }

    </script>

</body>

</html>
