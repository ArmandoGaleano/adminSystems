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
<div class="col-lg-4 col-md-6 col-sm-9 mb-4">

    <div class="card product animateSlideUp">
        <div class="imageLimiter">
            <a id="<?php echo $row["produtoID"] ?>" href="detalhes.php?item=<?php echo $row['produtoID']?>" class="d-flex justify-content-center align-items-center border-bottom linkEdit"><img class="card-img-top" src="<?php echo $row["imagem1"];?>" alt="<?php echo $row["nomeProduto"];?>"></a>
        </div>

        <div class="card-body d-flex justify-content-center align-items-center flex-column">
            <h4 class="card-title">
                <a href="detalhes.php?item=<?php echo $row['produtoID']?>" class="text-white linkEdit"><?php echo $row["nomeProduto"] ?></a>
            </h4>
            <h5 class="text-success">R$ <?php echo number_format($row["preco"],2,',','.') ?></h5>
        </div>
    </div>
</div>

<?php }//FINAL LIST ?>
<div class="w-100 d-flex justify-content-center">
    <nav>
        <ul class="pagination">
            <li class="page-item  <?php if($page == 1){echo 'disabled';}?>">
                <div class="page-link" id="prev" onclick="changePageArrow(-1);">Prev</div>
            </li>
            <?php //Se a página for igual a 1
                if($page == 1){?>
               
                    <li class="page-item paginator active">
                        <div class="page-link" onclick="changePage(this);"><?php echo $page;?></div>
                    </li>

                    <?php if($qntPages > 1){?>
                    <li class="page-item paginator">
                        <div class="page-link" onclick="changePage(this);"><?php echo $page+1;?></div>
                    </li>
                    <?php }?>

                    <?php if($qntPages > 2){?>
                    <li class="page-item paginator">
                        <div class="page-link" onclick="changePage(this);"><?php echo $page+2;?></div>
                    </li>
                    <?php }?>
                
            <?php }?>
            
            
            <?php //Se a página não for igual a 1 e nem igual a última página
                if($page != 1 && $page != $qntPages){?>
            
                   <?php if($qntPages > 1){?>
                    <li class="page-item paginator">
                        <div class="page-link" onclick="changePage(this);"><?php echo $page-1;?></div>
                    </li>
                    <?php }?>

                    <?php if($qntPages > 1){?>
                    <li class="page-item paginator active">
                        <div class="page-link" onclick="changePage(this);"><?php echo $page;?></div>
                    </li>
                    <?php }?>

                    <?php if($qntPages > 2){?>
                    <li class="page-item paginator">
                        <div class="page-link" onclick="changePage(this);"><?php echo $page+1;?></div>
                    </li>
                    <?php }?>
                
            <?php }?>
            
            
            <?php //Se a página for a última
                if($page == $qntPages){?>

                    <?php if($qntPages > 2){?>
                    <li class="page-item paginator">
                        <div class="page-link" onclick="changePage(this);"><?php echo $page-2;?></div>
                    </li>
                    <?php }?>

                    <?php if($qntPages > 1){?>
                    <li class="page-item paginator">
                        <div class="page-link" onclick="changePage(this);"><?php echo $page-1;?></div>
                    </li>
                    <?php }?>

                    <?php if($qntPages > 1){?>
                    <li class="page-item paginator active">
                        <div class="page-link" onclick="changePage(this);"><?php echo $page;?></div>
                    </li>
                    <?php }?>
                
            <?php }?>


            <li class="page-item <?php if($page == $qntPages){echo 'disabled';}?>">
                <div class="page-link" id="next" onclick="changePageArrow(1);">Next</div>
            </li>
        </ul>
    </nav>
</div>
