<?php
    class form extends CRUD{
        public $error = [];
        public $pathImages = [];
        public $validatedImages = [];
        function __construct($nome,$categoria,$preco,$description,$modoUsar,$arrayDataForm,$productID = null,$inputImg = null){
            $this->nome          = $nome;
            $this->categoria     = $categoria;
            $this->preco         = $preco;
            $this->description   = $description;
            $this->modoUsar      = $modoUsar;
            $this->arrayDataForm = $arrayDataForm;
            $this->productID     = $productID;
            $this->inputImg      = $inputImg;

        }
        private function validateImg(){
            if(
                isset($this->arrayDataForm['img1']) && !empty($this->arrayDataForm['img1']) ||
                isset($this->arrayDataForm['img2']) && !empty($this->arrayDataForm['img2']) ||
                isset($this->arrayDataForm['img3']) && !empty($this->arrayDataForm['img3'])
            ){
                $numberImage = 1;
                foreach($this->arrayDataForm as $file){
                    if(!empty($file['tmp_name'])){
                        $name = $file['name'];
                        $tmp = $file['tmp_name'];
                        $widthImg = getimagesize($tmp)[0];
                        $heightImg = getimagesize($tmp)[1];
                        if($widthImg <= 348 && $heightImg <= 280){
                            $this->validatedImages[] = $numberImage;
                        }else{
                            $this->error[] = 'As Dimenções da '.$numberImage.'° imagem não são 348x280';
                        }
                    }
                    $numberImage++;
                }
            }
        }
        private function validateForm(){
            if(empty($this->nome)){
                $this->error[] = "Necessário definir um nome ao produto";
             }
             //------
             if(empty($this->preco)){
                $this->error[] = "Necessário definir um preço ao produto";
            }//------
            if(empty($this->description)){
                $this->error[] = "Necessário dar uma descrição sobre o produto";
            }
        }
        private function insertIntoImgPaste($arrayFile){
            for($i = 0;$i < count($this->arrayDataForm);$i++){
                
                $arrayName = array_keys($this->arrayDataForm)[$i];
                if(!empty($this->arrayDataForm[$arrayName]['tmp_name'])){
                    $name       = $this->arrayDataForm[$arrayName]['name'];
                    $tmp        = $this->arrayDataForm[$arrayName]['tmp_name'];
                    //Upload image for server
                    $nameEx     = explode('.',$name);
                    $ext        = end($nameEx);
                     //folder where the image will be saved
                    $pasta      ='assets/images/produtos/jpg/';
                
                    $permiti    = array('jpg', 'jpeg', 'png');
                    $name      = uniqid().'.'.$ext; 
                    $uid        = uniqid();
                    
                    $widthImg   = getimagesize($tmp)[0];
                    $heightImg  = getimagesize($tmp)[1];
                    //Upload image for server
                    $upload     = move_uploaded_file($tmp, $pasta.'/'.$name);
                    global $pathImages;
                    $this->pathImages[$arrayName] = $pasta.$name;
                }
                
               
            }
        }
        public function createProduct(){
            //Validation of images
            $this->validateImg();
            //------
            $this->validateForm();
            $postImgs = [];
                    for($i = 0;$i < count($this->arrayDataForm);$i++){
                        if(!empty($this->arrayDataForm['img1']['tmp_name'])){
                            $postImgs['img1'] = true;
                        }else{
                            $postImgs['img1'] = false;
                        }//---------------------
                        if(!empty($this->arrayDataForm['img2']['tmp_name'])){
                            $postImgs['img2'] = true;
                        }else{
                            $postImgs['img2'] = false;
                        }//---------------------
                        if(!empty($this->arrayDataForm['img3']['tmp_name'])){
                            $postImgs['img3'] = true;
                        }else{
                            $postImgs['img3'] = false;
                        }//---------------------
                    }
            //add product
            if(empty($this->error)){
                $this->insertIntoImgPaste($this->arrayDataForm);
                //All images selected
                if($postImgs['img1'] === true && $postImgs['img2'] === true && $postImgs['img3'] === true){
                    $this->insertProduct($this->nome,$this->categoria,$this->pathImages['img1'],$this->pathImages['img2'],$this->pathImages['img3'],$this->description,$this->modoUsar,$this->preco);
                }
                if($postImgs['img1'] === true && $postImgs['img2'] === true && $postImgs['img3'] === false){
                    $this->insertProduct($this->nome,$this->categoria,$this->pathImages['img1'],$this->pathImages['img2'],null,$this->description,$this->modoUsar,$this->preco);
                }
                if($postImgs['img1'] === true && $postImgs['img2'] === false && $postImgs['img3'] === false){
                    $this->insertProduct($this->nome,$this->categoria,$this->pathImages['img1'],null,null,$this->description,$this->modoUsar,$this->preco);
                }
                
            }
        }
        public function updateDataProduct(){
                //Validation of images
                $this->validateImg();
                //------
                $this->validateForm();

                $dataProduct = $this->select('*','produtos','produtoID',$this->productID);
                $img1 = $dataProduct['imagem1'];
                $img2 = $dataProduct['imagem2'];
                $img3 = $dataProduct['imagem3'];
                //add product
                if(empty($this->error)){

                    $this->insertIntoImgPaste($this->arrayDataForm);

                    $postImgs = [];
                    for($i = 0;$i < count($this->arrayDataForm);$i++){
                        if(!empty($this->arrayDataForm['img1']['tmp_name'])){
                            $postImgs['img1'] = true;
                        }else{
                            $postImgs['img1'] = false;
                        }//---------------------
                        if(!empty($this->arrayDataForm['img2']['tmp_name'])){
                            $postImgs['img2'] = true;
                        }else{
                            $postImgs['img2'] = false;
                        }//---------------------
                        if(!empty($this->arrayDataForm['img3']['tmp_name'])){
                            $postImgs['img3'] = true;
                        }else{
                            $postImgs['img3'] = false;
                        }//---------------------
                    }
                    //Checks if all images are NOT selected in input
                    if($postImgs['img1'] === false && $postImgs['img2'] === false && $postImgs['img3'] === false){
                        //Check if image 2 and 3 are active
                        if($this->verifyInputActive() === true){
                            //Both images are checked
                            $this->updateProducts($this->nome,$this->categoria,$img1,$img2,$img3,$this->description,$this->modoUsar,$this->preco,$this->productID);
                        }
                        else if($this->verifyInputActive() === 1){
                            //input 1 checked
                            $this->updateProducts($this->nome,$this->categoria,$img1,$img2,null,$this->description,$this->modoUsar,$this->preco,$this->productID);
                        }
                        else if($this->verifyInputActive() === false){
                            //none checked
                            $this->updateProducts($this->nome,$this->categoria,$img1,null,null,$this->description,$this->modoUsar,$this->preco,$this->productID);
                        }

                    }
                    //Checks if all images have been selected in the input
                    if($postImgs['img1'] === true && $postImgs['img2'] === true && $postImgs['img3'] === true){
                        //Upload all
                        $this->updateProducts($this->nome,$this->categoria,$this->pathImages['img1'],$this->pathImages['img2'],$this->pathImages['img3'],$this->description,$this->modoUsar,$this->preco,$this->productID);
                    }
                    if($postImgs['img1'] === true && $postImgs['img2'] === true){
                        //Checks if image 3 input is checked
                        if($this->verifyInputActive() === true){
                            //Both images are checked
                            $this->updateProducts($this->nome,$this->categoria,$this->pathImages['img1'],$this->pathImages['img2'],$img3,$this->description,$this->modoUsar,$this->preco,$this->productID);
                        }
                        else{
                            $this->updateProducts($this->nome,$this->categoria,$this->pathImages['img1'],$this->pathImages['img2'],null,$this->description,$this->modoUsar,$this->preco,$this->productID);
                        }
                    }
                    if($postImgs['img2'] === true && $postImgs['img3'] === true){
                        //Default first image
                        $this->updateProducts($this->nome,$this->categoria,$img1,$this->pathImages['img2'],$this->pathImages['img3'],$this->description,$this->modoUsar,$this->preco,$this->productID);
                    }
                    if($postImgs['img1'] === true && $postImgs['img3'] === true && $this->inputImg[0] === 1){
                        //Checks if image 2 input is checked
                        $this->updateProducts($this->nome,$this->categoria,$this->pathImages['img1'],$img2,$this->pathImages['img3'],$this->description,$this->modoUsar,$this->preco,$this->productID);
                    }
                    //------------------------------------
                    //Image only 1
                    if($postImgs['img1'] === true && $postImgs['img2'] === false && $postImgs['img3'] === false){
                        
                        //Verify Image 2 and 3 are Checked
                        if($this->verifyInputActive() === true){
                            //Both images are checked
                            $this->updateProducts($this->nome,$this->categoria,$this->pathImages['img1'],$img2,$img3,$this->description,$this->modoUsar,$this->preco,$this->productID);
                        }
                        else if($this->verifyInputActive() === 1){
                            //input 1 checked
                            $this->updateProducts($this->nome,$this->categoria,$this->pathImages['img1'],$img2,null,$this->description,$this->modoUsar,$this->preco,$this->productID);
                        }
                        else if($this->verifyInputActive() === false){
                            //none checked
                            $this->updateProducts($this->nome,$this->categoria,$this->pathImages['img1'],null,null,$this->description,$this->modoUsar,$this->preco,$this->productID);
                        }
                    }
                    //Image Only 2
                    if($postImgs['img1'] === false && $postImgs['img2'] === true && $postImgs['img3'] === false){
                        //Verify Image 3 is Checked
                        if($this->verifyInputActive() === true){
                            //Both images are checked
                            $this->updateProducts($this->nome,$this->categoria,$img1,$this->pathImages['img2'],$img3,$this->description,$this->modoUsar,$this->preco,$this->productID);
                        }
                        else{
                            $this->updateProducts($this->nome,$this->categoria,$img1,$this->pathImages['img2'],null,$this->description,$this->modoUsar,$this->preco,$this->productID);
                        }
                    }
                    //Image Only 3
                    if($postImgs['img1'] === false && $postImgs['img2'] === false && $postImgs['img3'] === true && $this->inputImg[0] === 1){
                        $this->updateProducts($this->nome,$this->categoria,$img1,$img2,$this->pathImages['img3'],$this->description,$this->modoUsar,$this->preco,$this->productID);
                    }
                }
            
    }
    
    private function verifyInputActive(){
        if(!empty($this->inputImg)){
            $inputActive = [];
            for($i = 0;$i < count($this->inputImg);$i++){
                if($this->inputImg[$i] === 1){
                    $inputActive[] = 1;
                } 
                else if($this->inputImg[$i] === 2){
                    $inputActive[] = 2;
                }
            }
            if(count($inputActive) === 2){
                //The two active inputs
                return true;
            }
            else{
                if($inputActive[0] === 1){
                    //Input 1 only active
                    return 1;
                }
                else if($inputActive[0] === 2){
                    //Input 2 only active
                    return 2;
                }
            }
        }
        else{
            //None input
            return false;
        }
    }
    //Validation data of product
     function validationData($postProduct){
        if(!empty($postProduct)){
            return true;
        }else{
            return false;
        }
     }
}
?>