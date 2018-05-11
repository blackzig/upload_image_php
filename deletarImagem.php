<?php
include './upload.php';

    $nomePasta = "1";
    $destination = "documentos/$nomePasta";   
    $diretorioThumb = $destination."/thumb";    
    
$caminhoImagem = $_GET['ci'];
//echo'</br> '.$caminhoImagem;
$imagemThumb = $_GET['di'];
//echo'</br> '.$imagemThumb;

$nomeArquivo = @end(explode('/', $caminhoImagem));
//echo'</br> $nomeArquivo '.$nomeArquivo;

//nome do arquivo sem a extensão
$nomeArquivo2 = preg_replace("/\.[^.]*$/","",$nomeArquivo); 
//echo'</br> $nomeArquivo2 '.$nomeArquivo2;

//caso exista o doc ou docx apagar
$caminhoDoDoc   = $destination."/".$nomeArquivo2.".doc";
$caminhoDoDocx  = $destination."/".$nomeArquivo2.".docx";

//echo'</br> $caminhoDoDoc '.$caminhoDoDoc;
//echo'</br> $caminhoDoDocx '.$caminhoDoDocx;

if(file_exists($caminhoImagem)){
    unlink($caminhoImagem);
    unlink($imagemThumb); 
    if(file_exists($caminhoDoDoc)){
        unlink($caminhoDoDoc);
    }    
    if(file_exists($caminhoDoDocx)){
        unlink($caminhoDoDocx);
    }     
}

?>

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