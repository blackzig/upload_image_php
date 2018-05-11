<?php
require './src/Cloudinary.php';
require './src/Uploader.php';
require './src/Api.php';

require './settings.php';


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
        <title></title>
        
    <script type="text/javascript">
//        $(document).ready(function(){
//            $("#eager_sample").click(function () {
//                alert('teste');
////                var pesquisa = $("#pesquisa").val();          
////                //alert(pesquisa);
////                 $( "#tabela" ).html('<img src=almoxarifado/imgs/RBM.gif> <label style="color:#B20856;font-family:Arial;font-size:14px;">Aguarde...</label>');       
////                $.ajax({
////                url: 'almoxarifado/phpsql/arqcadastrodeposito/busca_usuario.php?pesquisa='+pesquisa,
////                type: "post",
////                    success: function(data) {
////                        $('#tabela').html(data);    
////                       // $('#tabela table > tbody:first').find('tr:first').before(data);
////                    }              
////                }); 
//            });  
//        });  
        function teste(t){
            var url = t;
            alert(t);
            newwindow=window.open(url,'fullscreen=yes');
            if (window.focus) {newwindow.focus();}
            return false; 
        }
    </script>        
    </head>
    <body>
<?php
  //  $file='Documentos/1/uc_finito.pdf';
   // \Cloudinary\Uploader::upload('uc_finito.pdf');
$t = $_SERVER['DOCUMENT_ROOT'];
echo'</br> t '.$t;
$caminhoImagem = "documentos/1/uc_finito.pdf";
$caminhoImagem1 = "documentos/1/texto.pdf";
//\Cloudinary\Uploader::upload('C:\xampp\htdocs\apache_pb.gif');
//\Cloudinary\Uploader::upload( $_SERVER['DOCUMENT_ROOT'] . '/Imagem/Documentos/1/uc_finito.pdf');   

//\Cloudinary\Uploader::upload($_SERVER['DOCUMENT_ROOT'] . '/Imagem/Documentos/1/uc_finito.pdf', 
//                             array("public_id" => "uc_finito",
//                                   "eager" => array(
//                                     "width" => 150, "height" => 100, 
//                                     "crop" => "thumb", "gravity" => "face"
//                                   )
//                             ));

                           
//\Cloudinary\Uploader::upload($_SERVER['DOCUMENT_ROOT'] . '/Imagem/Documentos/1/uc_finito.pdf', 
//    array( 
//      "eager" => array("width" => 150, "height" => 100, 
//                       "crop" => "thumb", "gravity" => "face"),
//      "eager_async" => true, 
//      "eager_notification_url" => "http://www.google.com.br"
//    ));

//echo cl_image_tag("zslttkdfzzp1asg8ivo6.jpg", 
//                        array( 
//                          "width" => 150, "height" => 100, 
//                          "crop" => "thumb", "gravity" => "face"
//                        )); 
?>
        <img onclick="teste('<?=$caminhoImagem;?>')" 
<?php             
echo cl_image_tag("uc_finito.jpg", array("width" => 150, "height" => 100, 
             "crop" => "fill", "radius" => 20));
        
?>
        <img onclick="teste('<?=$caminhoImagem1;?>')" 
<?php             
echo cl_image_tag("texto.jpg", array("width" => 150, "height" => 100, 
             "crop" => "fill", "radius" => 20));
        
?>             
    </body>
</html>
