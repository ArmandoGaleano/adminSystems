var startData = new FormData();
startData.append("pesquisa", '');
$.ajax({
    url: 'assets/ajax/returnProducts.php',
    method: 'post',
    data: startData,
    processData: false,
    contentType: false
}).done(function (resposta) {
    $('#products').html(resposta);
});

//------------

var data = new FormData();
$('#search').keyup(function () {
    $data = this.value;
    data.append("pesquisa", $data);
    $.ajax({
        url: 'assets/ajax/returnProducts.php',
        method: 'post',
        data: data,
        processData: false,
        contentType: false
    }).done(function (resposta) {
        $('#products').html(resposta);
    });
});


//Function for change pages with number
function changePage(div) {
    let dadosL = new FormData();
    $numberPage = +(div.textContent);
    dadosL.append("link", $numberPage);
    dadosL.append("pesquisa", $('#search')[0].value);
    $.ajax({
        url: 'assets/ajax/returnProducts.php',
        method: 'post',
        data: dadosL,
        processData: false,
        contentType: false
    }).done(function (resposta) {
        $('#products').html(resposta);
    });
}
//function for change page seta
function changePageArrow(number) {
    $currentPage = Number($('nav ul li.paginator.active')[0].textContent);
    $numberPage = $currentPage + (number);
    $numberPage = (($numberPage == 0) ? 1 : $numberPage);
    let dadosLLL = new FormData();
    $numberPage = +($numberPage);
    dadosLLL.append("link", $numberPage);
    dadosLLL.append("pesquisa", $('#search')[0].value);
    $.ajax({
        url: 'assets/ajax/returnProducts.php',
        method: 'post',
        data: dadosLLL,
        processData: false,
        contentType: false
    }).done(function (resposta) {
        $('#products').html(resposta);
    });
}
