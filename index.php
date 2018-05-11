<?php

include './upload.php';

    $nomePasta = "1";
    $destination = "documentos/$nomePasta";   
    $diretorioThumb = $destination."/thumb";    
?>
<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>   
    <script src="./elevatezoom-master/jquery.elevateZoom-3.0.8.min.js" type="text/javascript"></script>  
    <script src="./elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <meta charset="ISO-8859-1">
        <title>Upload de Imagens</title>
        
    <script type="text/javascript">

        function imprimirImagem(t){
            var url = "imprimirDocumentos.php?ci="+t;
            newwindow=window.open(url,'fullscreen=yes');
            if (window.focus) {newwindow.focus();}
            return false;        
        }
        
        function abrirPDF(t){
            var url = t;
            newwindow=window.open(url,'fullscreen=yes');
            if (window.focus) {newwindow.focus();}
            return false;             
        }

        function deletarImagem(t,u){
            $.ajax({
                url: 'deletarImagem.php?ci='+t+'&di='+u,
                type: "post",
                success: function(data) {
                                $('#documentosImagens').html(data);                   
                            }              
                });               
        }    

ok=false;
       function checarTodosOsCheckboxes(){
        if(!ok){
           for(var i=0; i<document.form1.elements.length; i++){
               var x = document.form1.elements[i];
               if(x.name === 'itens[]'){
                   x.checked = true;
                   ok=true;
               }
           }//fim do for
        }
        else{
           for(var i=0; i<document.form1.elements.length; i++){
               var x = document.form1.elements[i];
               if(x.name === 'itens[]'){
                   x.checked = false;
                   ok=false;
               }
           }//fim do for            
        }
       }
    </script>          
    
    </head>
    
    <body>  
        <p></p>
        <div class="container">
            <div class="col-md-6">
                <form action="" id="file" method="post" enctype="multipart/form-data">
                    <input type="file" name="img[]" multiple><p></p>
                    <input type="submit" name="upload" value="Upload Imagens">
                </form>                
            </div>    
            <div class="col-md-6">   
<!--            <form method="post" action="" enctype="multipart/form-data">
                <input type="file" name="docxToPDF[]" multiple><p></p>
                <input type="submit" name="docPDF" value="Transformar DOCX,DOC/PDF" />
            </form>                 -->
<!--            <form method="post" action="" enctype="multipart/form-data">
                <input type="file" name="pdf"><p></p>
                <input type="submit" name="submit" value="Upload PDF" />
            </form>     -->
            </div>             
        </div>

        <div class="container">
            <div align="center" class="col-md-12">             
                <hr><h2>Documentos Enviados</h2>
            </div>           
        </div>
      
        <div id="documentosImagens">
            <form name="form1" target="_blank" action="imprimirImagens.php" method="post"  enctype="multipart/form-data">        
                <?php
                    $arquivos = glob("$diretorioThumb/{*.*}",GLOB_BRACE);
                    //$arquivosReal = glob("$destination/{*.*}",GLOB_BRACE);                    
                    $cont = 1;
                ?>             
                    <div class="container">
                <?php                
                    foreach($arquivos as $img){
                    $i = explode("/", $img);
                    $nomeArquivo            = end($i);
                    
                    if(strpos($nomeArquivo, 'PDF') ==true){
                        $nomeArquivo1           = preg_replace("/[PDF]/","",$nomeArquivo);
                        $nomeArquivo2           = preg_replace("/[.jpg]/","",$nomeArquivo1);                        
                        $nomeArquivoComPDF      = $nomeArquivo2.".pdf";
                       /* echo'</br> $nomeArquivo1 '.$nomeArquivo1;
                        echo'</br> $nomeArquivo2 '.$nomeArquivo2; 
                        echo'</br> $nomeArquivo '.$nomeArquivo;  */                      
                        $caminhoImagemOriginal  = $destination."/".$nomeArquivoComPDF;
                        $caminhoImagemMiniatura = $diretorioThumb."/".$nomeArquivo;                                         
                    }
                    else{
                        $caminhoImagemOriginal  = $destination."/".$nomeArquivo;
                        $caminhoImagemMiniatura = $diretorioThumb."/".$nomeArquivo;                           
                    }
                    //echo'</br> $caminhoImagemOriginal '.$caminhoImagemOriginal;
                ?>                    
                        <div class="col-md-3" id="img">                    
                            <input id="checkboxImagem" type="checkbox" name="itens[]" value="<?=$caminhoImagemOriginal;?>"/><br/>    
                            <img id="<?=$cont;?>" src="<?=$img;?>"  data-zoom-image="<?=$caminhoImagemOriginal;?>" />   
                            <?php
                                if(strpos($caminhoImagemOriginal, '.pdf') ==true){
                            ?>    
                                <img src="Imagens/icone_impressora.gif" onclick="abrirPDF('<?=$caminhoImagemOriginal;?>')" />    
                            <?php 
                                }else{
                            ?>    
                                <img src="Imagens/icone_impressora.gif" onclick="imprimirImagem('<?=$caminhoImagemOriginal;?>')" /> 
                            <?php }
                            ?>
                            
                            <img src="Imagens/icon-delete.jpg" onclick="deletarImagem('<?=$caminhoImagemOriginal;?>','<?=$caminhoImagemMiniatura;?>')" />                    
                            <p></p>
                            <a href="<?=  $caminhoImagemOriginal; ?>"  target="_">Abrir</a>
                        </div>  
                <?php        
                    $cont++; }//fim do for
                ?>          
                        <!--<input type="submit" name="imprimirImagens" value="Imprimir Imagens Escolhidas">-->  
                        <button type="submit" class="btn btn-default" aria-label="Left Align" >
                      <span aria-hidden="true"> Imprimir todos os escolhidos</span>
                    </button>                          
                    </div>               
            </form> 
            <div class="container">
                <button type="button" class="btn btn-default" aria-label="Left Align" onclick="checarTodosOsCheckboxes()">
                  <span class="glyphicon glyphicon-ok" aria-hidden="true"> Selecionar Todos</span>
                </button>     
            </div>    
        </div>    
    <script type="text/javascript">
        $(document).ready(function () {
            var qtdImagem = <?=$cont;?>;
            //alert(qtdImagem);
            for(i=1; i<qtdImagem; i++){
                $("#"+i).elevateZoom({zoomWindowPosition: 14});                  
            }            
        });     
    
    </script>  
    
    </body>
</html>
