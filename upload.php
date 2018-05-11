<?php
    include './pdfaidservices/PdfaidServices.php';
        
    $nomePasta = "1";
    $destination = "documentos/$nomePasta";    
    $diretorioThumb = $destination."/thumb";    
    if(is_dir($destination)){
     //   echo"</br> Esta pasta já existe.";
    }
    else{
    //    echo'</br> Esta pasta não existe e será criada.';
        mkdir("documentos/$nomePasta");
        mkdir("documentos/$nomePasta"."/thumb");        
    }  
if(isset($_POST['docPDF'])){

    //INFO IMAGEM
    $file       = $_FILES['docxToPDF'];
    $numFile    = count(array_filter($file['name']));
    
    for($i=0; $i<$numFile; $i++){
        $name   = $file['name'][$i];
        $type   = $file['type'][$i];
        $size   = $file['size'][$i];
        $error  = $file['error'][$i];
        $tmp    = $file['tmp_name'][$i];
        //echo'</br> tmp '.$tmp;
        $myDoc2Pdf = new Doc2PdfConverter();
        $myDoc2Pdf->apiKey = "";
        //onde está o arquivo
        $entrada = $tmp;
       // echo'</br> $entrada '.$entrada;        
        $myDoc2Pdf->inputDocLocation = $entrada;
       
        $nomeArquivo2 = preg_replace("/\.[^.]*$/","",$name);        
        
        //please make sure that the dir is writable chmod 777
        $saida = $destination."/".$nomeArquivo2.".pdf";
     //   echo'</br> saída '.$saida;
        $myDoc2Pdf->outputPdfLocation = $saida;
        $result = $myDoc2Pdf->Doc2PdfConvert();         
    }
   
}    
//Imagens
if(isset($_POST['upload'])){
    
    //INFO IMAGEM
    $file       = $_FILES['img'];
    $numFile    = count(array_filter($file['name']));
    
    //PASTA
    $folder     = 'documentos';
    
    //Permitidos
    //$permite =  array('image/jpeg', 'image/png');
    
    //MENSAGENS
    $msg        = array();
    $errorMsg   = array(
        1 => 'O arquivo enviado excede o limite definido.',
        2 => 'Os arquivos enviado excede o tamanho permitido.',
        3 => 'O upload do arquivo foi feito parcialmente.',
        4 => 'Nenhum arquivo foi enviado.'
    );
    
    if($numFile<=0){
        echo'</br>Você não selecionou nenhum arquivo.';
    }
    else{
        for($i=0; $i<$numFile; $i++){
            $name   = $file['name'][$i];
            $type   = $file['type'][$i];
            $size   = $file['size'][$i];
            $error  = $file['error'][$i];
            $tmp    = $file['tmp_name'][$i];
                              //  echo'</br> tmp '.$tmp;
            $extensao = @end(explode('.', $name));
            //$novoNome = rand().".$extensao";
           // echo'</br> $type '.$type;
            if($error !=0){
                $msg[] = "<b>$name :<b> ".$errorMsg[$error];

            }
//            else if(!in_array($type, $permite)){
//                $msg[] = "<b>$name :<b> Este tipo de arquivo não é aceito.";                
//            }
            else{
               // echo'</br> $tmp: '.$tmp;
                //echo'</br> destino do arquivo: '.$destination;
                $diretorio      = $destination."/".$name;
                $diretorioThumb = $destination."/thumb";
               //echo'</br> $diretorio '.$diretorio;
                if(move_uploaded_file($tmp, $destination."/".$name)){ 
                    if($type=='application/vnd.openxmlformats-officedocument.wordprocessingml.document' || 
                       $type=='application/msword'){
                          echo'</br>';
                          echo'</br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                          . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                          . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;'
                          . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                          . '<a href="http://convertonlinefree.com/" '
                          . 'target="_blank">Transforme este arquivo em PDF antes do envio</a>';
//                        $myDoc2Pdf = new Doc2PdfConverter();
//                        $myDoc2Pdf->apiKey = "fak13kjnq10qo1";
//                        //onde está o arquivo
//                        $entrada = $diretorio;       
//                        $myDoc2Pdf->inputDocLocation = $entrada;
//
//                        $nomeArquivo2 = preg_replace("/\.[^.]*$/","",$name);        
//
//                        //please make sure that the dir is writable chmod 777
//                        $saida = $destination."/".$nomeArquivo2.".pdf";
//                        $myDoc2Pdf->outputPdfLocation = $saida;
//                        $result = $myDoc2Pdf->Doc2PdfConvert();    
//                        
//                        //PDF
//                        $pdfDirectory = $destination."/";
//                        $thumbDirectory = $diretorioThumb."/";
//
//                        //get the name of the file
//                        $filename = $name;                        
//                        $nomeArquivo2 = preg_replace("/\.[^.]*$/","",$filename);
//                        
//                        //name the thumbnail image the same as the pdf file
//                        $thumb = $nomeArquivo2;
//                       // echo'</br> $thumb '.$thumb;
//                                //the path to the PDF file
//                                $pdfWithPath = $pdfDirectory.$thumb.".pdf";   
//                               // echo'</br> $pdfWithPath '.$pdfWithPath;
//                                //add the desired extension to the thumbnail
//                                $thumb = $thumb."PDF.jpg"; 
//                      //  echo'</br> $thumb '.$thumb;                                
//                                $miniaturaPDF = $thumbDirectory.$thumb;
//                      //  echo'</br> $miniaturaPDF '.$miniaturaPDF;                                
//                                exec("convert \"{$pdfWithPath}[0]\" -colorspace RGB -geometry 200 $miniaturaPDF");
//                                //show the image
//                                //echo "<p><a href=\"$pdfWithPath\"><img src=\"$thumbDirectory$thumb\" alt=\"\" /></a></p>";                          
                    }
                    else if($type=='application/pdf'){
                        
                        $pdfDirectory = $destination."/";
                        $thumbDirectory = $diretorioThumb."/";

                        //get the name of the file
                        $filename = $name;                        
                        $nomeArquivo2 = preg_replace("/\.[^.]*$/","",$filename);
                        
                        //name the thumbnail image the same as the pdf file
                        $thumb = $nomeArquivo2;
                                //the path to the PDF file
                                $pdfWithPath = $pdfDirectory.$filename;     
                                //add the desired extension to the thumbnail
                                $thumb = $thumb."PDF.jpg";   
                                $miniaturaPDF = $thumbDirectory.$thumb;
                                exec("convert \"{$pdfWithPath}[0]\" -colorspace RGB -geometry 200 $miniaturaPDF");
                                //show the image
                               // echo "<p><a href=\"$pdfWithPath\"><img src=\"$thumbDirectory$thumb\" alt=\"\" /></a></p>";             
                        
                    }else{
                        $msg[] = "<b>$name: Documentos enviados.";
                        //listar propriedade desse arquivo
                        list($largura, $altura, $tipo) = getimagesize($diretorio);

                        //criar a imagem
                        if($type=='image/jpeg'){
                            $img    = imagecreatefromjpeg($diretorio);
                        }
                        else if($type=='image/png'){
                            $img    = imagecreatefrompng($diretorio);
                        }
                        else if($type=='image/bmp'){
                            $img    = imagecreatefromwbmp($diretorio);
                        }
                        //criar a thumb
                        $thumb  = imagecreatetruecolor(100, 100); 
                        //copiar a imagem para dentro do thumb
                        imagecopyresampled($thumb, $img, 0, 0, 0, 0, 100, 100, $largura, $altura);

                        //enviar para o diretório de thumb
                        if($type=='image/jpeg'){                    
                            imagejpeg($thumb,$diretorioThumb."/".$name);
                        }
                        else if($type=='image/png'){
                            imagepng($thumb,$diretorioThumb."/".$name);                        
                        }               
                        else if($type=='image/bmp'){
                            image2wbmp($thumb,$diretorioThumb."/".$name);                        
                        }                       
                        //liberar memória
                        imagedestroy($img);
                        imagedestroy($thumb);                        
                    }//fim do pdf                       
                }
                else{
                    $msg[] = "<b>Tente enviar menos documentos ou diminua "
                            . "o tamanho do arquivo $name.";                    
                }   
                
                foreach ($msg as $pop) {
                    echo $pop.'</br>';
                }
            }//fim do error
        }//fim do for
    }
    
}//fim do post upload


//PDF    
else if (isset($_POST['submit'])){
 
$pdfDirectory = $destination."/";
$thumbDirectory = $diretorioThumb."/";
 
//get the name of the file
$filename = basename( $_FILES['pdf']['name'], ".pdf");
//echo'</br>$filename '.$filename;
//remove all characters from the file name other than letters, numbers, hyphens and underscores
$filename = preg_replace("/[^A-Za-z0-9_-]/", "", $filename).".pdf";
//echo'</br>$filename '.$filename; 
//name the thumbnail image the same as the pdf file
$thumb = basename($filename, ".pdf");
//echo'</br>$thumb '.$thumb; 
$tmp    = $_FILES['pdf']['tmp_name'];
//echo'</br>$tmp '.$tmp; 
//echo'</br> verificar '.$pdfDirectory.$filename;
   // if(move_uploaded_file($_FILES['pdf']['tmp_name'], $pdfDirectory.$filename)) {
//print_r($_FILES);
    if(move_uploaded_file($tmp, $pdfDirectory.$filename)){ 
    //the path to the PDF file
    $pdfWithPath = $pdfDirectory.$filename;
 //echo'</br>$pdfWithPath '.$pdfWithPath;      
    //add the desired extension to the thumbnail
    $thumb = $thumb."PDF.jpg";
     
   // echo'</br>$thumb '.$thumb;   
    $miniaturaPDF = $thumbDirectory.$thumb;
   // echo'</br> verificar '.$thumbDirectory.$thumb;
    //execute imageMagick's 'convert', setting the color space to RGB and size to 200px wide
    exec("convert \"{$pdfWithPath}[0]\" -colorspace RGB -geometry 200 $miniaturaPDF");
         
    //show the image
    echo "<p><a href=\"$pdfWithPath\"><img src=\"$thumbDirectory$thumb\" alt=\"\" /></a></p>";
    }
}