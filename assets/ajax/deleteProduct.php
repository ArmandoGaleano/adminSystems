<?php
    require_once('../../class/Connection.php');
    require_once("../../class/CRUD.php");
    $CRUD = new CRUD();

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $path = $_POST['path'];
        //delete image
        if(is_file('../../'.$path)){
            @unlink('../../'.$path,null);
        }
            
        //delete product with this $id
        $CRUD->deleteProduct($id);
    }
    
?>
