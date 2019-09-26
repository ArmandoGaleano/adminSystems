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
                callback: function () {
                    //ajax DELETE
                    let data = new FormData();
                    data.append('id', id);
                    data.append('path', path);
                    $.ajax({
                        url: 'assets/ajax/deleteProduct.php',
                        method: 'post',
                        data: data,
                        processData: false,
                        contentType: false
                    }).done(function (resposta) {
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
                                    callback: function () {
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
                callback: function () {

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
