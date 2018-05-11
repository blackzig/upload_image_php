<?php

include "PDF/MPDF57/mpdf.php";
include "PDF/MPDF57/font/czapfdingbats.php";

$caminhoImagem = $_GET['ci'];
//echo'</br> '.$caminhoImagem;


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
</style>
    <img src="'.$caminhoImagem.'" /> 
</body>'; 
            
            $mpdf=new mPDF('c','A4','0','' , 15 , 15 , 16 , 16 , 9 , 9); 
            $mpdf->SetDisplayMode('fullpage');      
           // $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
            //$mpdf->WriteHTML(file_get_contents('testePDF.html'));
            $mpdf->WriteHTML(utf8_encode($html));            
            $mpdf->Output();  
            exit();                 
        ?>
    </body>
</html>
