<?php

    require_once("../../class/Connection.php");
    require_once("../../class/CRUD.php");

    $CRUD = new CRUD();
//PAGINAÇÃO

//QUANTIDADE DE PRODUTOS QUE IRMA APARECER NA TELA POR PÁGINA
$productsInPage = 12;
//PÁGINA QUE ESTÁ
$page = (isset($_POST['page'])?$_POST['page']:1);
if(isset($_POST['link'])){
    $link = $_POST['link'];

    $page = $link;
}



//APARTIR DE QUE PRODUTO VAI INICIAR
$start = ($productsInPage*$page) - $productsInPage;


    //CONSULTA NO BANCO DE DADOS
    if(isset($_POST['pesquisa'])){
        
        $pesquisa = addslashes($_POST['pesquisa']);
        $sql = "SELECT * FROM produtos";
        
        if(isset($_POST['filter']) && $_POST['filter'] != ''){
            $filter = $_POST['filter'];
            $sql = "SELECT * FROM produtos WHERE categoria = '$filter' ";
        }
        
        
        $rows = $CRUD->consultWithLimit($sql,$start,$productsInPage);
        $rowsWithSearch = $CRUD->consult($sql);
        
        if($pesquisa != ''){
            if(isset($_POST['filter']) && $_POST['filter'] != ''){
                $filter = $_POST['filter'];
                $sql = "SELECT * FROM produtos WHERE nomeProduto LIKE '%$pesquisa%' AND categoria = '$filter'";
            }
            else{
                $sql = "SELECT * FROM produtos WHERE nomeProduto LIKE '%$pesquisa%'";
            }
            //AQUI SOBREPOE A PESQUISA
            $rows = $CRUD->consultWithLimit($sql,$start,$productsInPage);
            $rowsWithSearch = $CRUD->consult($sql);
        }
        
    }
//TOTAL DE PRODUTOS NO BD
$totalItens = count($rowsWithSearch);
//QUANTIDADE DE PÁGINAS
$qntPages = ceil($totalItens/$productsInPage);

?>
<?php
foreach($rows as $row){
?>
<!-- LIST ALL PRODUCTS -->
<div class="col-md-6 col-lg-4 my-3">
    <div class="products border border-bottom-0 shadow">
        <div class="imageProduct d-flex justify-content-center">
            <a href="detalhes.php?item=<?php echo $row['produtoID'];?>"><img class="img-fluid" src="<?php echo $row["imagem1"];?>" alt=""></a>
        </div>
        <div class="detail d-flex flex-column">
            <h3 class="text-white text-center pt-4">
                <a class="text-white" href="detalhes.php?item=<?php echo $row['produtoID'];?>"><?php echo $row["nomeProduto"];?></a>
            </h3>
            <h3 class="text-white text-center">
                <a class="text-white" href="detalhes.php?item=<?php echo $row['produtoID'];?>">R$ <?php echo number_format($row["preco"],2,',','.') ?></a>
            </h3>
            <div class="d-flex justify-content-center flex-wrap pb-3">
                <button onclick="window.location.href='alterar-produto.php'" class="btn btn-warning mx-2"><b><i class="fas fa-pencil-alt"></i> Modificar</b></button>
                <button onclick="menssageDelete('<?php echo $row["nomeProduto"] ?>','<?php echo $row['produtoID'];?>','<?php echo $row["imagem1"];?>');" class="btn btn-danger text-white mt-1 mx-2"><b><i class="fas fa-trash"></i> Deletar</b></button>
            </div>
        </div>
    </div>
</div>

<?php }//FINAL LIST ?>
<!-- PAGINATION LINKS -->
<div class="w-100 d-flex justify-content-center">
    <nav>
        <ul class="pagination">
            <li class="page-item  <?php if($page == 1){echo 'disabled';}?>">
                <div class="page-link" id="prev" onclick="changePageArrow(-1);"><b>Prev</b></div>
            </li>
            <?php //Se a página for igual a 1
                if($page == 1){?>

            <li class="page-item paginator active">
                <div class="page-link" onclick="changePage(this);"><b><?php echo $page;?></b></div>
            </li>

            <?php if($qntPages > 1){?>
            <li class="page-item paginator">
                <div class="page-link" onclick="changePage(this);"><b><?php echo $page+1;?></b></div>
            </li>
            <?php }?>

            <?php if($qntPages > 2){?>
            <li class="page-item paginator">
                <div class="page-link" onclick="changePage(this);"><b><?php echo $page+2;?></b></div>
            </li>
            <?php }?>

            <?php }?>


            <?php //Se a página não for igual a 1 e nem igual a última página
                if($page != 1 && $page != $qntPages){?>

            <?php if($qntPages > 1){?>
            <li class="page-item paginator">
                <div class="page-link" onclick="changePage(this);"><b><?php echo $page-1;?></b></div>
            </li>
            <?php }?>

            <?php if($qntPages > 1){?>
            <li class="page-item paginator active">
                <div class="page-link" onclick="changePage(this);"><b><?php echo $page;?></b></div>
            </li>
            <?php }?>

            <?php if($qntPages > 2){?>
            <li class="page-item paginator">
                <div class="page-link" onclick="changePage(this);"><b><?php echo $page+1;?></b></div>
            </li>
            <?php }?>

            <?php }?>


            <?php //Se a página for a última
                if($page == $qntPages){?>

            <?php if($qntPages > 2){?>
            <li class="page-item paginator">
                <div class="page-link" onclick="changePage(this);"><b><?php echo $page-2;?></b></div>
            </li>
            <?php }?>

            <?php if($qntPages > 1){?>
            <li class="page-item paginator">
                <div class="page-link" onclick="changePage(this);"><b><?php echo $page-1;?></b></div>
            </li>
            <?php }?>

            <?php if($qntPages > 1){?>
            <li class="page-item paginator active">
                <div class="page-link" onclick="changePage(this);"><b><?php echo $page;?></b></div>
            </li>
            <?php }?>

            <?php }?>


            <li class="page-item <?php if($page == $qntPages){echo 'disabled';}?>">
                <div class="page-link" id="next" onclick="changePageArrow(1);"><b>Next</b></div>
            </li>
        </ul>
    </nav>
    <!-- PAGINATION LINKS END -->
</div>
