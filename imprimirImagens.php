<?php
//imprimi as imagens selecionadas
include "PDF/MPDF57/mpdf.php";
include "PDF/MPDF57/font/czapfdingbats.php";

$_checkbox  = array_values($_POST['itens']);
//traz o caminho dos arquivos originais    
//foreach ($_checkbox as $dados){
//    echo"</br> ".$dados;
//}


        
$html=' 

<style>
body {
	font-family: sans-serif;
}
//@page {
//	margin-top: 2.0cm;
//	margin-bottom: 2.0cm;
//	margin-left: 2.3cm;
//	margin-right: 1.7cm;
//	margin-header: 8mm;
//	margin-footer: 8mm;
//	footer: html_myHTMLFooter;
//	background-color:#ffffff;
//}

@page :first {
	margin-top: 6.5cm;
	margin-bottom: 2cm; 
	header: html_myHTMLHeader;
	footer: _blank;
	resetpagenum: 1;
	background-gradient: linear #FFFFFF #FFFF44 0 0.5 1 0.5; 
	background: #ccffff url(bgbarcode.png) repeat-y fixed left top; 
}
@page letterhead {
	margin-top: 2.0cm;
	margin-bottom: 2.0cm;
	margin-left: 2.3cm;
	margin-right: 1.7cm;
	margin-header: 8mm;
	margin-footer: 8mm;
	footer: html_myHTMLFooter;
	background-color:#ffffff;
}

@page letterhead :first {
	margin-top: 6.5cm;
	margin-bottom: 2cm; 
	header: html_myHTMLHeader;
	footer: _blank;
	resetpagenum: 1;
}
.gradient {
	border:0.1mm solid #220044; 
	background-color: #f0f2ff;
	background-gradient: linear #c7cdde #f0f2ff 0 1 0 0.5;
}
.rounded {
	border:0.1mm solid #220044; 
	background-color: #f0f2ff;
	background-gradient: linear #c7cdde #f0f2ff 0 1 0 0.5;
	border-radius: 2mm;
	background-clip: border-box;
}
h4 {
	font-weight: bold;
	margin-top: 1em;
	margin-bottom: 0.3em;
}
div.text {
	padding:1em; 
	margin-bottom: 0.25em;
	text-align:justify; 
}
div.artificial {
	font-family: arialuni; 	/* custom font using MS Arial Unicode  */
}
p { margin-top: 0; }
.code {
	font-family: mono;
	font-size: 9pt;
	background-color: #d5d5d5; 
	margin: 1em 1cm;
	padding: 0 0.3cm;
}
</style>';
foreach ($_checkbox as $dados){
$i = explode(".", $dados);
    $extensão = end($i);
    if($extensão<>'pdf'){
        $html1='
        <img src="'.$dados.'" />'; 
        $html1Juntado = $html1Juntado.$html1; 
    }
}//foreach
$html2='    
    </body>
</html>'; 
            $mpdf=new mPDF(); 
           // $mpdf->SetDisplayMode('fullpage');   
            foreach ($_checkbox as $dados){
            $j=explode(".", $dados);
                $extensão = end($j);
                if($extensão=='pdf'){   
                    $mpdf->SetImportUse();
                    $pagecount = $mpdf->SetSourceFile($dados);
                    for($i=1; $i<=$pagecount; $i++){
                        $mpdf->AddPage();                        
                        $import_page = $mpdf->ImportPage($i);
                        $mpdf->UseTemplate($import_page);
                    }//for
                    //$pdfExistente +=$pdf;
                }//if
            }//foreach
            $mpdf->AddPage();            
            $mpdf->WriteHTML(utf8_encode($html.$html1Juntado.$html2));            
            $mpdf->Output();  
            //exit();               
        ?>
    </body>
</html>
